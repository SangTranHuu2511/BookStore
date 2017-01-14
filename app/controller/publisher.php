<?php  
	require_once 'app/model/publisher_model.php';

	$method = isset($_GET['m']) ? trim($_GET['m']) : 'index';
	switch ($method) {
		case 'index':
			listAllBookByPublisher();
			break;
	
	}
	function listAllBookByPublisher(){

		$idPB = isset($_GET['idPB']) ?($_GET['idPB']) : 0;
		$idPB = is_numeric($idPB) ? $idPB : 0;
		$listBookByPB = get_all_book_by_publisher($idPB);
		
		if(empty($listBookByPB)){
			require_once 'app/view/errors_view.php';
		}
		else{
			require_once 'app/view/publisher/index_view.php';

		}
	}

?>