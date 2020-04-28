<?php 
include_once('init.php');
if(isset($_REQUEST) && isset ($_REQUEST['method']))
{
	if ($_REQUEST['method'] == "post") {
		$username= $_GET['username'];
		$password= $_GET['password'];

		if ($username && $password) {
			$sql = "SELECT * FROM users WHERE username='".$username."' AND password = '".$password."'";
			$query = $connect->query($sql);
			if ($query->num_row >= 1) {
				$userdata = mysqli_fetch_array($query);
				$token = bin2hex(openssl_random_pseudo_bytes(4));
				$_SESSION['id'] = $userdata['id'];
				$_SESSION ['token'] = $token;
				$data = ['token' => $_SESSION['token'],
						'message' => "Successfully login"];
					header('Content-type: application/json');
					echo json_encode($data);
			}else {
				$data = [
						'message' => "Incorrect username/password combination"];
					header('Content-type: application/json');
					echo json_encode($data);
			}
		}
	}
}



?>