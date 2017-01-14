<?php
session_start();
require_once 'app/helpers/common_helper.php';
require_once 'app/config/constant.php';
require_once 'app/libs/vn2latin.php';
require_once 'app/libs/Myencryptdecrypt.php';
require_once 'app/libs/sendmail.php';

$cn = isset($_GET['cn']) ? trim($_GET['cn']) : 'index';

if($cn != 'signup' && $cn != 'login'){
  require_once 'app/view/partials/header_view.php';
  if($cn != 'cart'){
    require_once 'app/view/partials/banner_view.php';
  }
}

switch ($cn) {
  case 'index':
    require_once 'app/controller/home.php'; 
    break;
  case 'home':
    require_once 'app/controller/home.php';
    break;
  case 'search' :
    require_once 'app/controller/search.php';
  break;
  case 'typebook' :
    require_once 'app/controller/typebook.php';
  break;
  case 'price':
    require_once 'app/controller/price.php';
    break;
  case 'signup':
    require_once 'app/controller/signup.php';
    break;
  case 'login':
    require_once 'app/controller/login.php';
    break;
  case 'logout':
    require_once 'app/controller/logout.php';

    break;
  case 'cart':
    require_once 'app/controller/cart.php';
    break;
  case 'publisher':
    require_once 'app/controller/publisher.php';
    break;
    

}

if($cn != 'signup' && $cn != 'login'){
  if($cn != 'cart'){
    require_once'app/controller/menu.php';
      
  }

require_once 'app/view/partials/footer_view.php';
}

?>