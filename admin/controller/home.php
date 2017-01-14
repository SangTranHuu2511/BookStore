<?php
session_start();

require_once '../config/constant.php';

require_once '../helper/helper.php';
checkLoginAdmin();

require_once '../libs/thirdparty/FlashMessages.php';

$cn = isset($_GET['sk']) ? $_GET['sk'] : 'index';
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])!=='xmlhttprequest'){
  require_once '../view/partials/header_view.php';
  require_once '../view/partials/aside_view.php';
}

switch ($cn) {
  case 'book':
    require_once 'book.php';
    break;
  case 'publisher':
    require_once 'publisher.php';
    break;
  case 'index':
    require_once '../view/home_view.php';
    break;
  case 'orders':
    require_once 'orders.php';
    break;

  default:
  require_once '../view/home_view.php';
    break;
}
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])!=='xmlhttprequest'){
    require_once '../view/partials/footer_view.php';
}
?>
