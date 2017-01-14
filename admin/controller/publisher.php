<?php
require_once '../model/publisher_model.php';


$method = isset($_GET['m']) ? $_GET['m'] : 'index';
switch ($method) {
  case 'index':
    listAllPublisher();
    break;
  case 'add' :
    addPulisher();
    break;
  case 'edit':
    editPulisher();
    break;
  case 'delete':
    deletePublisher();
    break;
  default:
  listAllPublisher();
  break;
}

function deletePublisher(){
  $msg  = new \Plasticbrain\FlashMessages\FlashMessages();
  $idPb = isset($_GET['id']) ? $_GET['id'] : '';
  $idPb = is_numeric($idPb) ? $idPb : 0;
  $dataInfo = getDataInfoPublisher($idPb);
  if(empty($dataInfo)){
    require_once '../view/notfound_view.php';
  }
  else{
    $delete = deleDataPublisher_model($idPb);
    if($delete){
      $msg->error('Xóa thành công');
      header("Location:?sk=publisher");
    }else{
      $msg->error('Xóa thất bại');
      header("Location: ?sk=publisher");
    }
  }
}

function editPulisher(){
  $msg = new \Plasticbrain\FlashMessages\FlashMessages();

  $idPb = isset($_GET['id']) ? $_GET['id'] : 0;
  $dataInfo = getDataInfoPublisher($idPb);
  if(empty($dataInfo)){
    require_once '../view/notfound_view.php';
  }
  else
  {
    require_once '../view/publisher/editPulisher_view.php';
  }

  // submit edit
  if(isset($_POST['btnSubmit'])){
    $name = isset($_POST['txtName']) ? $_POST['txtName'] : '';
    $name = strip_tags($name);
    $hddName = isset($_POST['hddNamePB']) ? $_POST['hddNamePB'] : '';
    $hddName = strip_tags($hddName);

    $phone = isset($_POST['txtPhone']) ? $_POST['txtPhone'] : '';
    $phone = strip_tags($phone);

    $addresss = isset($_POST['txtAddress']) ? $_POST['txtAddress'] : '';
    $addresss = strip_tags($addresss);

    $hddLogo = isset($_POST['hddFile']) ? $_POST['hddFile'] : '';
    $hddLogo = strip_tags($hddLogo);

    $logo = "";
    $type = 1;
    if(isset($_FILES['txtFile'])){
      $logo = uploadFiles($_FILES,$type);
    }
    $strLogoNXB = (empty($logo)) ? $hddLogo : $logo;

    $check = validate_data($name, $phone, $addresss, $strLogoNXB);
    $flag  = TRUE;
    foreach ($check as $key => $value) {
      if(!empty($value)){
        $flag  = FALSE;
        break;
      }
    }
    if($flag){
      $checkUsername = TRUE;
      if($name !== $hddName){
        $checkUsername = checkName($name);
      }
      if($checkUsername){
        $update = updateDataPublisher_model($name, $phone, $addresss, $strLogoNXB,$idPb);
        if($update){
          $msg->error('Sửa thành công');
          header("Location: ?sk=publisher");
        }else{
          $msg->error('Sửa thất bại');
          header("Location: ?sk=publisher&m=edit&id={$idPb}");
        }
      }else{
        $msg->error('Tên nhà xuất bản đã tồn tại');
        header("Location: ?sk=publisher&m=edit&id={$idPb}");
      }
    }else{
      $msg->error('Dữ liệu nhập sai');
      header("Location: ?sk=publisher&m=edit&id={$idPb}");
    }
  }
}

function listAllPublisher(){

  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

  // lay du lieu ra de hien thi len bang dl
  $dataPb   = getAllDataPublisher($keyword);

  $link = create_link(BASE_URL, array("sk"=>"publisher","m"=>"index","page"=>'{page}',"keyword"=>$keyword));
  $dataPaging = paging($link, count($dataPb), $page, ROW_LIMIT, $keyword);

  $dataPublisher = getDataPublisherByPage($dataPaging['start'], $dataPaging['limit'],$dataPaging['keyword']);

  $msg = new \Plasticbrain\FlashMessages\FlashMessages();
  require_once '../view/publisher/index_view.php';
}

function addPulisher(){

  $msg = new \Plasticbrain\FlashMessages\FlashMessages();
  require_once '../view/publisher/addPublisher_view.php';

  if(isset($_POST['btnSubmit']))
  {
    $name = isset($_POST['txtName']) ? $_POST['txtName'] : '';
    $name = strip_tags($name);

    $phone = isset($_POST['txtPhone']) ? $_POST['txtPhone'] : '';
    $phone = strip_tags($phone);

    $addresss = isset($_POST['txtAddress']) ? $_POST['txtAddress'] : '';
    $addresss = strip_tags($addresss);

    $logo = "";
    $type = 1;
    if(isset($_FILES['txtFile'])){
      $logo = uploadFiles($_FILES,$type);
    }

    $check = validate_data($name, $phone, $addresss, $logo);
    $flag  = TRUE;
    foreach ($check as $key => $value) {
      if(!empty($value)){
        $flag  = FALSE;
        break;
      }
    }

    if($flag){
      $ck1 = checkName($name);
      if($ck1){
        $add = add_info_publisher_model($name, $phone, $addresss, $logo);
        if($add){
          $msg->success('Thêm thành công !');
          header("Location: home.php?sk=publisher&m=index");
        }else{
          $msg->error('Dữ liệu nhập sai 2');
        }
      }
      else{
         $msg->error('Tên nhà xuất bản đã tồn tại.');
         header("Location: home.php?sk=publisher&m=add");
      }

    }else{
      $msg->error('Dữ liệu nhập sai');
    }
  }
}

function validate_data($name, $phone, $addresss, $logo){
  $errors = array();
  $errors['username'] = (empty($name) OR strlen($name) < 3) ? "name không được để trống và lớn hơn 3 kí tự" : "";
  $errors['phone']    = (empty($phone)) ? "Phone không được để trống" : "";
  $errors['add']  = (empty($addresss)) ? "Address không được để trống" : "";
  $errors['logo'] = (empty($logo)) ? "Logo không được để trống" : "";

  return $errors;
}

function checkName($name)
{
  $checkUsername =   checkExitsUsername($name);
  return $checkUsername;
}
?>