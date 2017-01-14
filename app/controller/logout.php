<?php  
	if($_SESSION['username']){
		unset($_SESSION['username']);
		unset($_SESSION['email']);
		unset($_SESSION['phone']);
		unset($_SESSION['address']);
		unset($_SESSION['fullname']);
		header("Location:?cn=index");

	}

?>