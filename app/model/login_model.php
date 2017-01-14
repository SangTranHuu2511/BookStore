<?php  
	require_once 'app/config/database.php';
	function check_login_user($username,$password){
		$conn = connection();
		$data = array();
		$sql = 'SELECT * FROM taikhoan WHERE TenDangNhap =:user AND MatKhau =:pass';
		$stm = $conn->prepare($sql);
		if($stm){
			$stm->bindParam(':user',$username,PDO::PARAM_STR);
			$stm->bindParam(':pass',$password,PDO::PARAM_STR);
			if($stm->execute()){
				if($stm->rowCount() > 0){
					$data = $stm->fetch(PDO::FETCH_ASSOC);
				}
			}
			$stm->closeCursor();
		}

		disconnection($conn);

		return $data;

	}

?>