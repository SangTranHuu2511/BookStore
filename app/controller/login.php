<?php  
	require_once 'app/model/login_model.php';
	$method = isset($_GET['m']) ? $_GET['m'] : 'index';
	switch ($method) {
	 	case 'index':
	 		formLogin();
	 		break;
	 	case 'logins':
	 		myLogin();
	 		break;
	 } 


	function formLogin(){
		require_once 'app/view/login/index_view.php';
		
	}
	function myLogin(){
		if(isset($_POST['btnSubmit'])){
			$username = isset($_POST['txtTenDangNhap']) ? trim($_POST['txtTenDangNhap']) : '';
			$password = isset($_POST['txtMatKhau']) ? $_POST['txtMatKhau'] : '';
			$check = validate_data($username,$password);
			$flag = TRUE;
			foreach ($check as $key => $value) {
				if(!empty($value)){
					$flag = FALSE;
					break;
				}
			}
			if($flag){
				if(isset($_SESSION['errors'],$_SESSION['error'])){
					unset($_SESSION['errors']);
					unset($_SESSION['error']);

				}

				$ckLogin = check_login_user($username,md5($password));
				
				if(!empty($ckLogin)){
					$_SESSION['username'] = $ckLogin['TenDangNhap'];
					$_SESSION['fullname'] = $ckLogin['TenHienThi'];
					$_SESSION['email'] = $ckLogin['Email'];
					$_SESSION['phone'] = $ckLogin['SDT'];
					$_SESSION['address'] = $ckLogin['DiaChi'];
					header("Location:?cn=index");

				}
				else{
					$_SESSION['error'] = 'Loi mat khau hoac username';
					header("Location:?cn=login&m=index");

				}

			}
			else{
				$_SESSION['errors'] = $check;//Loi validate form
				header('Location:?cn=login&m=index');

			}
		}
	}
	function validate_data($username,$password){
		$errors = array();
		$errors['username'] = empty($username) ? 'Username khong dc bo trong' : '';
		$errors['password'] = (strlen($password) < 8 ) ? 'Loi mat khau' : '';

		return $errors;
	}
	

?>