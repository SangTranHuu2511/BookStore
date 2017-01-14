<?php
require_once 'app/model/home_model.php';

$method = isset($_GET['m']) ? trim($_GET['m']) : 'index';
switch ($method) {
  case 'index':
    listAllBook();
    break;
  case 'detail':
    detailBook();
    break;
  case 'price':
    getAllBookByPrice();
    break;


}
function listAllBook(){
  $dataBook = get_list_all_book_model();
  require_once 'app/view/home/index_view.php';
}

function detailBook(){

  $idString = isset($_GET['name']) ? $_GET['name'] : '';
  $arrString = explode("-", $idString);
  $id = end($arrString);
  $id = is_numeric($id) ? $id : 0;
  $infodata = get_info_data_book_by_id($id);
  if(!empty($infodata)){
    $dataTypeBook = get_type_book($infodata['id_loai'],$id);
    $updateView = update_views_model($id,$infodata['SoLuotXem']);
    require_once 'app/view/home/detail_view.php';

  }
  else{
    require_once 'app/view/errors_view.php';
  }
}

function getAllBookByPrice(){
  $idPrice = isset($_GET['id']) ? $_GET['id'] : 0;
  $idPrice = is_numeric($idPrice) ? $idPrice : 0;
  //lay danh sach nhung quyen sach co gia trong khoang 0-500,000d
  $listBookFirst = get_list_book_by_price($idPrice);
  if(empty($listBookFirst)){
    require_once 'app/view/errors_view.php';

  }
  else{
    require_once 'app/view/home/booksByPrice_view.php';


  }


}
?>