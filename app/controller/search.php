<?php
require_once 'app/model/search_model.php';

$method = isset($_GET['m']) ? trim($_GET['m']) : 'index';
switch ($method) {
  case 'index':
    listDataSearch();
    break;
}

function listDataSearch(){
  $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
  $data = get_databook_by_keyword($keyword);
  if(empty($data)){
  	require_once 'app/view/errors_view.php';

  }
  else{
  	require_once 'app/view/search/index_view.php';
  }
  
}
?>