<?php

require_once 'app/model/menu_model.php';
$method = isset($_GET['m']) ? trim($_GET['m']) : 'index';

switch ($method) {
  case 'index':
    getDataMenu();
    break;

  
}


function getDataMenu(){
  // lay dl the loai sach
  $typeBook = get_all_typebook_model();

  // lay dl tac gia
  $author = get_all_author_model();

  // lay dl nxb
  $publisher = get_all_publisher_model();
  $bookTop5 = get_book_top5_model();
  require_once 'app/view/partials/menu_right_view.php';
}


?>