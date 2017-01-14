<?php
require_once '../model/books_model.php';

$method = isset($_GET['m']) ? $_GET['m'] : "index";
switch ($method) {
  case 'index':
    listAllBook();
    break;
  case 'add':
    addBooks();
    break;  
  case 'edit':
    editBook();
    break;
  default:
    listAllBook();
    break;
}

function editBook(){
  $msg  = new \Plasticbrain\FlashMessages\FlashMessages();
  //lay all data tac gia
  $dataAuthor = get_all_data_author_model();
  // lay all data NXB
  $dataPublisher = get_all_data_publisher_model();
  // lay all data loai sach
  $dataTypeBook = get_all_data_typebook_model();

  $idbook = isset($_GET['id']) ? $_GET['id'] : 0;
  $idbook = is_numeric($idbook) ? $idbook : 0;
  $infoBook = get_info_data_book($idbook);

  if(empty($infoBook))
  {
    require_once '../view/notfound_view.php';
  }
  else{
    require_once '../view/book/editbook_view.php';
  }

  if(isset($_POST['btnSubmit']))
  {
    $namebook = isset($_POST['txtNameBook']) ? $_POST['txtNameBook'] : "";
    $namebook = strip_tags($namebook);
    $hddNameBook = isset($_POST['txthddNamebook']) ? $_POST['txthddNamebook'] : "";
    $hddNameBook = strip_tags($hddNameBook);

    $author = isset($_POST['slcAuthor']) ? $_POST['slcAuthor'] : "";
    $author = is_numeric($author) ? $author : 0;

    $publisher = isset($_POST['slcPublisher']) ? $_POST['slcPublisher'] : "";
    $publisher = is_numeric($publisher) ? $publisher : 0;

    $typebook = isset($_POST['slcTypeBook']) ? $_POST['slcTypeBook'] : "";
    $typebook = is_numeric($typebook) ? $typebook : 0;

    $imgBook = "";
    $hddImg = isset($_POST['txtdhhFile']) ? $_POST['txtdhhFile'] : "";
    if(isset($_FILES['txtFile'])){
      $imgBook = uploadFiles($_FILES,3);
    }

    $realImgBook = (empty($imgBook)) ? $hddImg : $imgBook;

    $costBook = isset($_POST['txtCostBook']) ? $_POST['txtCostBook'] : "";
    $costBook = is_numeric($costBook) ? $costBook : 0;

    $newCostBook = isset($_POST['txtNewCostBook']) ? $_POST['txtNewCostBook'] : "";
    $newCostBook = is_numeric($newCostBook) ? $newCostBook : 0;

    $slcStatus = isset($_POST['slcStatus']) ? $_POST['slcStatus'] : "";
    $slcStatus = is_numeric($slcStatus) ? $slcStatus : 0;

    $qtyBook = isset($_POST['txtQTYBook']) ? $_POST['txtQTYBook'] : "";
    $qtyBook = is_numeric($qtyBook) ? $qtyBook : 0;

    $pageBook = isset($_POST['txPageBook']) ? $_POST['txPageBook'] : "";
    $pageBook = is_numeric($pageBook) ? $pageBook : 0;

    $chkData = validate_book($namebook, $author, $publisher,  $typebook, $realImgBook, $qtyBook, $costBook, $pageBook);
    $flag = TRUE;
    foreach ($chkData as $key => $v) {
      if(!empty($v)){
        $flag = FALSE;
        break;
      }
    }
    if($flag){
      $flagCheckName = TRUE;
      if($namebook !== $hddNameBook){
        $flagCheckName = TRUE;
        // checkExitsUsername($namebook);
      }
      if($flagCheckName){
        // update data book
        $update = update_info_book($idbook, $namebook, $author, $publisher,  $typebook, $realImgBook, $qtyBook, $costBook, $newCostBook,$slcStatus,  $pageBook);
        if( $update){
          $msg->success('Edit Success');
          header("Location:home.php?sk=book");

        }else{
          $msg->error('Edit Fail');
          header("Location:home.php?sk=book&m=edit&id=".$idbook);
        }
      }
      else
      {
        if(isset($_SESSION['error'])){
          unset($_SESSION['error']);
        }
        $msg->error('Tên sách đã tồn tại');
        header("Location:home.php?sk=book&m=edit&id={$idbook}");
      }
    }
    else{
      $msg->error('Nhập sai dữ liệu');
      $_SESSION['error'] = $chkData;
      header("Location:home.php?sk=book&m=edit&id={$idbook}");
    }
  }
}

function addBooks(){
  $msg  = new \Plasticbrain\FlashMessages\FlashMessages();
  //lay all data tac gia
  $dataAuthor = get_all_data_author_model();
  // lay all data NXB
  $dataPublisher = get_all_data_publisher_model();
  // lay all data loai sach
  $dataTypeBook = get_all_data_typebook_model();

  require_once '../view/book/addbook_view.php';

  if(isset($_POST['btnSubmit'])){
    $namebook = isset($_POST['txtNameBook']) ? $_POST['txtNameBook'] : "";
    $namebook = strip_tags($namebook);

    $author = isset($_POST['slcAuthor']) ? $_POST['slcAuthor'] : "";
    $author = is_numeric($author) ? $author : 0;

    $publisher = isset($_POST['slcPublisher']) ? $_POST['slcPublisher'] : "";
    $publisher = is_numeric($publisher) ? $publisher : 0;

    $typebook = isset($_POST['slcTypeBook']) ? $_POST['slcTypeBook'] : "";
    $typebook = is_numeric($typebook) ? $typebook : 0;

    $imgBook = "";
    if(isset($_FILES['txtFile'])){
      $imgBook = uploadFiles($_FILES,3);
    }

    $costBook = isset($_POST['txtCostBook']) ? $_POST['txtCostBook'] : "";
    $costBook = is_numeric($costBook) ? $costBook : 0;

    $qtyBook = isset($_POST['txtQTYBook']) ? $_POST['txtQTYBook'] : "";
    $qtyBook = is_numeric($qtyBook) ? $qtyBook : 0;

    $pageBook = isset($_POST['txPageBook']) ? $_POST['txPageBook'] : "";
    $pageBook = is_numeric($pageBook) ? $pageBook : 0;

    $chkData = validate_book($namebook, $author, $publisher,  $typebook, $imgBook, $qtyBook, $costBook, $pageBook);
    $flag = TRUE;
    foreach ($chkData as $key => $v) {
      if(!empty($v)){
        $flag = FALSE;
        break;
      }
    }
    if($flag){
      // xu ly add vao db
      $add = add_book_model($namebook, $author, $publisher,  $typebook, $imgBook, $qtyBook, $costBook, $pageBook);
      if($add){
        if(isset($_SESSION['error'])){
          unset($_SESSION['error']);
        }
        $msg->error('Thêm thành công');
        header("Location:home.php?sk=book");
      }else{
        if(isset($_SESSION['error'])){
          unset($_SESSION['error']);
        }
        $msg->error('Thêm thất bại');
        header("Location:home.php?sk=book&m=add");
      }
    }else{
      $msg->error('Nhập sai dữ liệu');
      $_SESSION['error'] = $chkData;
      header("Location:home.php?sk=book&m=add");
    }
  }
}

function validate_book($nameBook, $author, $publisher, $typeBook, $imgBook, $qtyBook, $costBook, $pageBook){
  $errors = array();
  $errors['namebook']  = (empty($nameBook)) ? "Vui lòng nhập tên sách" : "";
  $errors['author']    = ($author <= 0) ? "Vui lòng chọn Tác giả" : "";
  $errors['publisher'] = ($publisher <= 0) ? "Vui lòng chọn NXB" : "";
  $errors['typebook']  = ($typeBook <= 0) ? "Vui lòng chọn loại sách" : "";
  $errors['img']  = (empty($imgBook)) ? "Vui lòng chọn ảnh sách" : "";
  $errors['qty']  = ($qtyBook <= 0) ? "Vui lòng nhập số lượng" : "";
  $errors['cost'] = ($costBook <= 0) ? "Vui lòng nhập giá sách" : "";
  $errors['page'] = ($pageBook <= 0) ? "Vui lòng nhập số trang sách" : "";
  return $errors;
}
function listAllBook(){
  $msg  = new \Plasticbrain\FlashMessages\FlashMessages();
  if(isset($_SESSION['error'])){
    unset($_SESSION['error']);
  }

  $allDataBook = get_all_data_book();
  require_once '../view/book/index_view.php';
}

?>
