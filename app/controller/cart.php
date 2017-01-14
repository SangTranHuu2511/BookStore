<?php
	require_once 'app/model/home_model.php';
	$method = isset($_GET['m'])? $_GET['m'] : 'index';
	switch ($method) {
	 	case 'index':
	 		show_cart();
	 		break;
	 	case 'add':
	 		add_cart();
	 	case 'edit':
	 		edit_cart();
	 		break;
	 	case 'delete':
	 		delete_cart();
	 		break;
	 	case 'remove':
	 		remove_all_cart();
	 		break;
	 	case 'orders':
	 		orders_customer();
	 		break;
	 }
	 function show_cart(){
	 	
	 	if(empty($_SESSION['cart'])){
	 		unset($_SESSION['cart']);
	 		$mess_not_exist_cart = 'Giỏ hàng rỗng';
	 	}
	 	$mess = isset($_GET['mess']) ? $_GET['mess'] : '';
	 	$mess0 = (!empty($mess) && $mess == 'false') ? 'Giỏ hàng đang rỗng' : '';
	 	$mess1 = (!empty($mess) && $mess == 'errDB') ? 'Có lỗi xảy ra trong DB,Vui lòng kiểm tra lại' : '';
	 	$mess2 = (!empty($mess) && $mess == 'errValidate') ? 'Vui lòng điền đầy đủ thông tin' : '';
	 	$mess3 = (!empty($mess) && $mess == 'success') ? 'Cảm ơn bạn đã đặt hàng,Vui lòng chờ xác nhận từ Admin' : '';
	 	require_once 'app/view/cart/index_view.php';
	 }
	 function add_cart(){
	 	$idBook = isset($_GET['id']) ? $_GET['id'] : 0;
	 	$idBook = is_numeric($idBook) ? $idBook : 0;
	 	$infoBook = get_info_data_book_by_id($idBook);
	 	if(!empty($infoBook)){
	 		$qty = isset($_POST['txtSoLuong']) ? $_POST['txtSoLuong'] : 1;
	 		if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
		 		if(isset($_SESSION['cart'][$idBook]) && $_SESSION['cart'][$idBook]['idBook'] == $idBook){
		 			$_SESSION['cart'][$idBook]['qty'] += $qty;

		 		}
		 		else{

		 			$_SESSION['cart'][$idBook]['nameBook'] = $infoBook['TenSach'];
		 			$_SESSION['cart'][$idBook]['imageBook'] = $infoBook['HinhAnh'];
		 			$_SESSION['cart'][$idBook]['cost'] = $infoBook['GiaCu'];
		 			
		 			$_SESSION['cart'][$idBook]['idBook'] = $infoBook['id'];
		 			$_SESSION['cart'][$idBook]['qty'] = $qty;


		 		}
		 		
		 	}
	 		else{
	 			$_SESSION['cart'][$idBook]['idBook'] = $infoBook['id'];
	 			$_SESSION['cart'][$idBook]['nameBook'] = $infoBook['TenSach'];
	 			$_SESSION['cart'][$idBook]['imageBook'] = $infoBook['HinhAnh'];
	 			$_SESSION['cart'][$idBook]['cost'] = $infoBook['GiaCu'];
	 			
	 			$_SESSION['cart'][$idBook]['qty'] = $qty;

	 		}
	 		header("Location:?cn=cart");

	 	}
	 	else{
	 		require_once 'app/view/errors_view.php';
	 	}
	 }
	 function edit_cart(){
	 	if((isset($_POST['update']))){
			$qty = isset($_POST['txtSoLuong'])? $_POST['txtSoLuong'] : array();
			foreach ($qty as $key => $value) {
				 if(isset($_SESSION['cart'][$key])){
				 	$_SESSION['cart'][$key]['qty'] = $value;

				 }
			}
			header("Location:?cn=cart&m=index"); 		

	 	}

	 }
	 function delete_cart(){
	 	$idBook = isset($_GET['id']) ? $_GET['id'] : 0;
	 	$idBook = is_numeric($idBook) ? $idBook : 0;
	 	if(isset($_SESSION['cart'][$idBook])){
	 		unset($_SESSION['cart'][$idBook]);
	 		header("Location:?cn=cart&m=index");

	 	}

	 }
	 function remove_all_cart(){
	 	if(isset($_SESSION['cart'])){
	 		unset($_SESSION['cart']);
	 		header("Location:?cn=cart&m=index");

	 	}
	 }

	 function orders_customer(){
	 	if(isset($_POST['btnSubmit'])){
	 		if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
	 			$fullname = isset($_POST['txtHoTen']) ? $_POST['txtHoTen'] : '';
	 			$phone = isset($_POST['txtSoDienThoai']) ? $_POST['txtSoDienThoai'] : '';
	 			$address = isset($_POST['txtDiaChi']) ? $_POST['txtDiaChi'] : '';
	 			$email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '';
	 			$note = isset($_POST['txtGhiChu']) ? $_POST['txtGhiChu'] : '';
	 			$checkUserInfo = validate_data($fullname,$phone,$address,$email);
	 			$flag = TRUE;
	 			foreach ($checkUserInfo as $key => $value) {
	 				if(!empty($value)){
	 					$flag = FALSE;
	 					break;

	 				}
	 			}
	 				

	 			if($flag){
	 				$checkModel = FALSE;
	 				foreach ($_SESSION['cart'] as $key => $value) {
	 					$money = $value['cost'] * $value['qty'];					
	 					$checkModel = insert_order_customer($value['idBook'],$fullname,$phone,$address,$email,$note,$value['qty'],$money);
	 				}
	 				if($checkModel){
	 						//dat hang thanh cong
	 						//insert thanh cong
	 						header("Location:?cn=cart&m=index&mess=success");
	 						unset($_SESSION['cart']);
	 					}
	 					else{
	 						//loi trong db khong insert dc
	 						header("Location:?cn=cart&m=index&mess=errDB");
	 					}
	 			}
	 			else{
	 				//Loi validate data;
	 				header("Location:?cn=cart&m=index&mess=errValidate");
	 			}

	 		}
	 		else{
	 			//Gio hang trong va nguoi dung kich dat hang

	 			header("Location:?cn=cart&m=index&mess=false");

	 		}
	 	}
	 }

	 function validate_data($fullname,$phone,$address,$email){
	 	  $errors = array();
		  $errors['username'] = (empty($fullname)) ? 'Errors Username' : '';
		  $checkEmail = filter_var($email , FILTER_VALIDATE_EMAIL);
		  $errors['email'] = ($checkEmail == TRUE) ? '' : 'Errors Email';
		  $errors['fullname'] = (empty($fullname)) ? 'Errors Fullname' : '';
		  $errors['address'] = (empty($address)) ? 'Errors Address' : '';
		  $checkPhone = preg_match('/^[0][9]\d{8}$|^[0][1]\d{9}$/',$phone);
		  $errors['phone'] = ($checkPhone == TRUE) ? '' : 'Errors Phone ';

		  return $errors;
	 }

?>