<?php

function get_username_admin(){
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  return $username ;
}

function get_email_admin(){
  $email = isset($_SESSION['emailAdmin']) ? $_SESSION['emailAdmin'] : '';
  return $email ;
}

function get_cookie_admin(){
  $cookie = isset($_COOKIE['admin']) ? $_COOKIE['admin'] : "";
  return $cookie;
}

function checkLoginAdmin(){
  $username = get_username_admin();
  $email    = get_email_admin();
  $cookie   = get_cookie_admin();
  if(empty($username) OR empty($email) OR empty($cookie))
  {
    session_destroy();
    header("Location: ../index.php");
    die();
  }
}

function uploadFiles($file, $type){
  if($file['txtFile']['error'] == 0){
    $tmtPath = $file['txtFile']['tmp_name'];
    if(!empty($tmtPath)){
      $path = "";
      switch ($type) {
        case '1':
          $path = "../../upload/logoPublisher/".$file['txtFile']['name'];
          break;
        case '2':
          $path = "../../upload/imgAuthor/".$file['txtFile']['name'];
         break;
        case '3' :
          $path = "../../upload/imgBook/".$file['txtFile']['name'];
          break;
      }

      if(!empty($path)){
        $up = move_uploaded_file($tmtPath, $path);
        if($up){
          return $file['txtFile']['name'];
        }
        return;
      }
    }
  }
}

// uri : base url:
// filter : cac tham so tren link cua controller nao do
function create_link($uri, $filter = array()){
  $string = "";
  foreach ($filter as $k => $v) {
    $string .= "&{$k}={$v}";
  }
  return $uri . ($string ? "?".ltrim($string, "&") : "");
}

// ham phan trang
function paging($link, $totalRecord, $currentPage, $limit, $keyword = ""){

  // tinh tong so trang
  $totalPage = ceil($totalRecord/$limit);

  // xu ly gioi han cho currentpage
  if($currentPage > $totalPage ){
    $currentPage = $totalPage;
  }elseif($currentPage < 1){
    $currentPage = 1;
  }

  // tinh start
  $start = ($currentPage - 1) * $limit;

  // tao template phan trang
  $html  = "<div class='text-center'>";
  $html .= "<nav aria-label='Page navigation'>";
  $html .= "<ul class='pagination'>";
  // kiem tra nut privew (back)
  if($currentPage > 1 && $totalPage > 1)
  {
    $html .= "<li><a href='" . str_replace('{page}',$currentPage-1, $link) ."'><span aria-hidden='true'>&laquo;</span></a></li>";
  }
  // tinh cac trang o giua
  for($i = 1; $i <= $totalPage; $i++){
    // truong hop currentpage = trang hien thi
    if($i == $currentPage){
      $html .= "<li class='active'><a>" . $i . "<span class='sr-only'></span></a></li>";
    }else{
      $html .= "<li><a href='" . str_replace('{page}',$i,$link) ."'>" . $i . "</a></li>";
    }
  }
  // xu ly cho nut next
  if($currentPage < $totalPage && $totalPage > 1){
    $html .= "<li><a href='" . str_replace('{page}',$currentPage+1,$link) ."'><span aria-hidden='true'>&raquo;</span></a></li>";
  }
  $html .= "</ul>";
  $html .= "</nav>";
  $html .= "</div>";

  return array(
    "start" =>$start,
    "html"  =>$html,
    "keyword" =>$keyword,
    "limit" =>$limit
  );
}
?>