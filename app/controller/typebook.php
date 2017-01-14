<?php
require_once 'app/model/typebook_model.php';
$method= isset($_GET['m']) ? $_GET['m'] : 'index';
switch ($method) {
  case 'index':
    getListTypeBook();
    break;
}

function getListTypeBook(){
  $idtypeBook = isset($_GET['idType']) ? $_GET['idType'] : 0;
  $idtypeBook = is_numeric($idtypeBook) ? $idtypeBook : 0;
  $dataTypeBook = get_list_book_by_type($idtypeBook);

  if(!empty($dataTypeBook)){
    require_once 'app/view/typebook/index_view.php';
  }
  else{  
    require_once 'app/view/errors_view.php';
  }

  // $idPrice = isset($_GET['idPC']) ? $_GET['idPC'] : 0;
  // $idPrice = is_numeric($idPrice) ? $idPrice : 0;
  // $dataByPriceBook = get_list_book_by_price($idPrice);
 
  // if(!empty($dataByPriceBook)){
  //   require_once 'app/view/price/index_view.php';
  // }
  // else{  
  //   require_once 'app/view/errors_view.php';
  // }
  
}
?>