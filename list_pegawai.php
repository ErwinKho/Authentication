<?php  
include_once('init.php');
if(isset($_REQUEST) && isset ($_REQUEST['method']))
{
	if (isset($_SESSION['id'])) {
		if ($_REQUEST['method'] == "get") {
			$token = $_GET['token'];
			$c_token = $_SESSION['token'];
			if ($c_token == $token) {
				$select = "SELECT * FROM pegawai";
				$req = $connect->query($select);
				$array = [];
				while ($data = $req->fetch_assoc()) {
					$array[] = $data;
				}
				header('Content-type: application/json');
				echo json_encode($array);
			} else{
				$data = [
						'message' => "Token salah"];
					header('Content-type: application/json');
					echo json_encode($data);
			}
		}else{
			$data = [
					'message' => "please re-login"];
					header('Content-type: application/json');
					echo json_encode($data);
		}
	}
}


?>