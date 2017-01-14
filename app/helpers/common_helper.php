<?php  
	function get_session_fullname(){
		if(isset($_SESSION['fullname'])){
			return $_SESSION['fullname'];
		}
		return '';
	}
	function get_session_email(){
		if(isset($_SESSION['email'])){
			return $_SESSION['email'];
		}
		return '';
	}
	function get_session_phone(){
		if(isset($_SESSION['phone'])){
			return $_SESSION['phone'];
		}
		return '';
	}
	function get_session_address(){
		if(isset($_SESSION['address'])){
			return $_SESSION['address'];
		}
		return '';
	}
	


?>