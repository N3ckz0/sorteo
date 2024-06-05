<?php
class AppController
{
	function __construct(){
		//Login Model
		require_once "models/LoginModel.php";
		//Config Model
		require_once "models/ConfigModel.php";
		//Encoded Controller
		require_once "controllers/Encoded.php";
		//Admin Controller
		require_once "controllers/Admin.php";
		//User Controller
		require_once "controllers/User.php";
	}


	function login()	{
		$config = new Config_model;
		session_start();
		$_SESSION['config'] = $config->getData();
		require_once "views/app/login.php";
	}//end login

	function verify(){
		//form data
		$user = $_POST['user'];
		$password = $_POST['password'];
		//model instance
		$ec = new EncodedController;
		$log = new Login_model;
		//query
		$data['user'] = $log->getUser($user);
		//verify if user exist
		if($data['user']){
			//If password isn't encrypt
			if($ec->decrypt($data['user']['contrasena'])==null){
				//Verify if the password from form is the same that database
				$data['data'] = ($data['user']['contrasena']==$password) ? $data['user'] : null;
			}else{
				//Decrypt and verify if the password from form is the same that database
				$data['data'] = ($ec->decrypt($data['user']['contrasena'])==$password) ? $data['user'] : null;
			}
			//If user is verified
			if($data['data']){
				session_start();
				//verify if user is admin or super user
				switch ($data['data']['idTipoUsuario']) {
					case '1':
						$_SESSION['Admin'] = $data["data"];
						header('Location:/admin/index');
						break;
					case '2':
						$_SESSION['User'] = $data["data"];
						header('Location:/user/index');
						break;
				}
			}else{
				$this->login();
				echo "<script src='assets/js/login.js'></script>";
				echo "<script>PassError();</script>";
			}
		}else{
			$this->login();
			echo "<script src='assets/js/login.js'></script>";
			echo "<script>UserError();</script>";
		}
	}//end verify

	function endSession(){
		session_start();
		session_destroy();
		header('Location:/admin');
	}//end of endSession

}
?>