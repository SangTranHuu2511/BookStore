<?php
	require_once '../model/orders_model.php';
	$method = isset($_GET['m']) ? $_GET['m'] : 'index';

	switch ($method) {
		case 'index':
			listAllOrders();
			break;
		case 'handleOrder':
			updateOrderCustomer();
			break;
		default:
			# code...
			break;
	}
	function listAllOrders(){
		$listOrders = get_all_orders_model();
		
		
		require_once '../view/orders/index_view.php';
	}
	function updateOrderCustomer(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$id = is_numeric($id) ? $id : 0;
		$type = isset($_POST['type']) ? $_POST['type'] : 0;
		$type = is_numeric($type) && in_array($type, array(1,2)) ? $type : 0;
		if($type != 0 && $id != 0){
			if($type == 1){
				$update = update_orders_model($id);
				if($update){
					//echo "success";
					$detailOrders = saveOrder($id);
					if($detailOrders){
						echo 'success';

					}
					else{
						echo "Co loi xay ra";
					}

				}
				else{
					echo "false in db";

				}

			}
			elseif($type == 2){
				$del = delete_orders_model($id);
				if($del){
					echo "Xoa Thanh Cong";

				}
				else{
					echo "delete That Bai Trong Db";
				}


			}
		}
		else{

		}
	}
	

?>