<?php  
	require_once 'app/model/price_model.php';
	$method = isset($_GET['m']) ? $_GET['m'] : 'index';
	switch ($method) {
		case 'index':
			listAllBookByPrice();
			break;
		
		default:
			# code...
			break;
	}
	function listAllBookByPrice(){
		$idPrice = isset($_GET['idPC'])? $_GET['idPC'] : 0;
		$idPrice = is_numeric($idPrice) ? $idPrice : 0;
		$listBookByPrice = get_list_all_book_by_price($idPrice);
		
		if(empty($listBookByPrice)){
			require_once 'app/view/errors_view.php';
		}
		else{
			require_once 'app/view/price/index_view.php';


		}
	}

?>