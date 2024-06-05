<?php
class AdminController
{
	function __construct(){
		//Counters Model
		require_once "models/CountersModel.php";
		//Config Model
		require_once "models/ConfigModel.php";
		//Stripe Model
		require_once "models/StripeModel.php";
		//Category Controller
		require_once "models/CategoryModel.php";
		//Users Controller
		require_once "models/UsersModel.php";
		//Rewards Controller
		require_once "models/RewardsModel.php";
		//Encoded Controller
		require_once "controllers/Encoded.php";
	}//end construct

	function index(){
		//title
		$data['title'] = "Inicio";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		//Counts for aside menu
		$data['users'] = $count->countUsers();
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		$data['categories'] = $count->countCategories();
		$data['participants'] = $count->countParticipants();
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		require_once "views/app/admin/index.php";
	}//end index()

	function users(){
		//title
		$data['title'] = "Usuarios";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		$users = new Users_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//Users data
		session_start();
		$_SESSION['users'] = $users->getUsers();
		require_once "views/app/admin/users.php";
	}//end users()

	function newUser(){
		//title
		$data['title'] = "Agregar Usuario";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		require_once "views/app/admin/newUser.php";
	}//end newUser()

	function addUser(){
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		$ec = new EncodedController;
		$users = new Users_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//form data
		$nombre = $_POST['name'];
		$apaterno = $_POST['psurname'];
		$amaterno = $_POST['msurname'];
		$usuario = $_POST['user'];
		$correo = $_POST['mail'];
		$telefono = $_POST['phone'];
		$contrasena = $_POST['password'];
		//data encrypted
		$_nombre = $ec->encrypt($nombre);
		$_apaterno = $ec->encrypt($apaterno);
		$_amaterno = $ec->encrypt($amaterno);
		$_correo = $ec->encrypt($correo);
		$_telefono = $ec->encrypt($telefono);
		$_contrasena = $ec->encrypt($contrasena);
		//add user to database the new user
		$users->saveUser($_nombre,$_apaterno,$_amaterno,$usuario,$_correo,$_telefono,$_contrasena);
		$this->users();
		echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Usuario agregado exitosamente',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/users';
				}, 1000);</script>";
	}//end addUser

	function modifyUser($id){
		//title
		$data['title'] = "Modificar Usuario";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		$ec = new EncodedController;
		$users = new Users_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//Show  a page to modify user
		session_start();
		$_SESSION['user'] = $users->getUser($id);
		require_once "views/app/admin/modifyUser.php";
	}//end modifyUser

	function saveUser(){
		//model instance
		$ec = new EncodedController;
		$users = new Users_model;
		//form data
		$id = $_POST['idUser'];
		$nombre = $_POST['name'];
		$apaterno = $_POST['psurname'];
		$amaterno = $_POST['msurname'];
		$usuario = $_POST['user'];
		$correo = $_POST['mail'];
		$telefono = $_POST['phone'];
		//get data from database
		$data['user'] = $users->getUser($id);
		//verify if there are changes on user
		$changes = true;
		if($ec->decrypt($data['user']['nombre']) == $nombre)
			if($ec->decrypt($data['user']['apaterno']) == $apaterno)
				if($ec->decrypt($data['user']['amaterno']) == $amaterno)
					if($data['user']['usuario'] == $usuario)
						if($ec->decrypt($data['user']['correo']) == $correo)
							if($ec->decrypt($data['user']['telefono']) == $telefono)
								$changes = false;

		if($changes){
			$_nombre = $ec->encrypt($nombre);
			$_apaterno = $ec->encrypt($apaterno);
			$_amaterno = $ec->encrypt($amaterno);
			$_correo = $ec->encrypt($correo);
			$_telefono = $ec->encrypt($telefono);
			$users->modifyUser($id,$_nombre,$_apaterno,$_amaterno,$usuario,$_correo,$_telefono);
			$this->users();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Usuario modificado exitosamente',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/users';
				}, 1000);</script>";
		}else{
			$this->modifyUser($id);
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>Swal.fire({
		        icon: 'error',
		        title: 'Error',
		        text: 'No has modificado el usuario'
		    }).then((result) => {
		        if (result.isConfirmed) {
		            window.location.href = '/admin/users';
		        }
		    });</script>";
		}
	}//end saveUser

	function deleteUser($id){
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		$users = new Users_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//delete user from database
		$users->deleteUser($id);
		$this->users();
	}//end deleteUser

	function authorizedRewards(){
		//title
		$data['title'] = "Premios Autorizados";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//Get authorized reward from database
	    $estado_session = session_status();
	    if($estado_session == PHP_SESSION_NONE){session_start();}
		$_SESSION['authorized'] = $rewards->getAuthorizedRewards();
		require_once "views/app/admin/availableRewards.php";
	}//end authorizedRewards

	function reward(){
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//verify if there is an active reward
		session_start();
		$_SESSION['active'] = $rewards->getActiveReward();
		//show a view if there are or there aren't an active reward
		if($_SESSION['active'] != null){
			$data['title'] = "Premio Activo";
			require_once "views/app/admin/activeReward.php";
		}else{
			$this->authorizedRewards();
		}
	}//end reward

	function pendingRewards(){
		//title
		$data['title'] = "Premios Pendientes";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//Get pending rewards form database
		session_start();
		$_SESSION['pending'] = $rewards->getPendingRewards();
		require_once "views/app/admin/pendingRewards.php";
	}//end pendingRewards

	function rejectedRewards(){
		//title
		$data['title'] = "Premios Denegados";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//Get pending rewards form database
		session_start();
		$_SESSION['rejected'] = $rewards->getRejectedRewards();
		require_once "views/app/admin/rejectedRewards.php";
	}//end rejectedRewards

	function authorize($id){
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//Change status of reward from database
		$rewards->authorizeReward($id);
		$this->reward();
	}//end authorize

	function deny($id){
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//Change status of reward from database
		$rewards->denyReward($id);
		$this->reward();
	}//end deny

	function active($id){
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//Change status of reward from database
		$data['activereward'] = $rewards->getActiveReward();
		if($data['activereward'] != null){
			$rewards->disableReward($data['activereward']['id']);
		}
		$rewards->activeReward($id);
		$this->reward();
	}//end active

	function disable($id){
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//Change status of reward from database
		$rewards->disableReward($id);
		$this->reward();
	}//end disable

	function rewards(){
		//title
		$data['title'] = "Premios";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		//Counts for aside menu
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//get rewards from db
		$estado_session = session_status();
	    if($estado_session == PHP_SESSION_NONE)
	    {
	        session_start();
	    }
		$_SESSION['rewards'] = $rewards->getRewards();
		require_once "views/app/admin/rewards.php";
	}//end rewards

	function deleteReward($id){
		//model instance
		$rewards = new Rewards_model;
		//delete reward
		$rewards->deleteReward($id);
		header("Location: ../rewards");
	}//end deleteReward

	function newReward(){
		//title
		$data['title'] = "Nuevo Premio";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		$catego = new Category_model;
		//Counts for aside menu
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//
		session_start();
		$_SESSION['categoriestorewards'] = $catego->getCategories();
		if($_SESSION['categoriestorewards'] == null){
			$this->rewards();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>Swal.fire({
			  title: 'Primero agrega una categoría',
			  icon: 'warning',
			  showConfirmButton: false,
			  timer: 2000,
			  timerProgressBar: true,
			}).then(() => {
			  window.location.href = '/admin/categories';
			});</script>";
		}else{
			require_once "views/app/admin/newReward.php";
		}
	}//end newReward

	function addReward(){
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//save reward
		$nombre = $_POST['reward'];
		$descripcion = $_POST['description'];
		$imagen = "assets/media/premios/" . $_POST['url-img'];
		$categoria = $_POST['categories'];
		$fecha = $_POST['date'];
		$precioBoleto = $_POST['ticket'];
		$descripcionSorteo = $_POST['info'];

		//AGREGA LA IMAGEN AL SERVIDOR
		if( isset($_FILES['imagen']) ){
			//Obtiene la informacion del archivo seleccionado
			$file = $_FILES['imagen'];
			$filename = $file["name"];
			$mimetype = $file["type"];
			$name = $file['tmp_name'];
			//Verifica el tipo de archivo seleccionado
			$allowed_files = array("image/jpg", "image/jpeg", "image/png");
			if( !in_array($mimetype, $allowed_files) ){
				header("Location: rewards");
			}
			//Crea el directorio si no existe
			if( !is_dir("assets/media/premios") ){
				mkdir("assets/media/premios",0777);
			}
			//Mueve el archivo a la carpeta del directorio
			$urlCompleta = "assets/media/premios/" . $filename;
			if( !file_exists($urlCompleta) ){
				$rewards->saveImage($urlCompleta);
				move_uploaded_file($name, $urlCompleta);
			}
			$rewards->saveReward($nombre,$descripcion,$imagen,$categoria,$fecha,$precioBoleto,$descripcionSorteo);
		}
		$this->rewards();
		echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Premio agregado exitosamente',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/rewards';
				}, 1000);</script>";
	}//end addReward

	function modifyReward($id){
		//title
		$data['title'] = "Modificar Premio";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		$catego = new Category_model;
		//Counts for aside menu
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//
		session_start();
		$_SESSION['categoriestorewards'] = $catego->getCategories();
		$_SESSION['reward'] = $rewards->getReward($id);
		require_once "views/app/admin/modifyReward.php";
	}//end modifyReward

	function saveReward(){
		//model instance
		$rewards = new Rewards_model;
		//form data
		$id = $_POST['idReward'];
		$nombre = $_POST['reward'];
		$descripcion = $_POST['description'];
		$imagen = $_POST['url-img'];
		$categoria = $_POST['categories'];
		$fecha = $_POST['date'];
		$precioBoleto = $_POST['ticket'];
		$descripcionSorteo = $_POST['info'];
		//verify  if there are changes
		$changes = true;
		$data['reward'] = $rewards->getReward($id);
		if( isset($_FILES['imagen']) ){
			//Obtiene la informacion del archivo seleccionado
			$file = $_FILES['imagen'];
			$filename = $file["name"];
			$mimetype = $file["type"];
			$name = $file['tmp_name'];
			//Verifica el tipo de archivo seleccionado
			$allowed_files = array("image/jpg", "image/jpeg", "image/png");
			if( !in_array($mimetype, $allowed_files) ){
				header("Location: rewards");
			}
			//Crea el directorio si no existe
			if( !is_dir("assets/media/premios") ){
				mkdir("assets/media/premios",0777);
			}
			//Mueve el archivo a la carpeta del directorio
			$urlCompleta = "assets/media/premios/" . $filename;
			if( !file_exists($urlCompleta) ){
				$rewards->saveImage($urlCompleta);
				move_uploaded_file($name, $urlCompleta);
			}
		}

		if ($data['reward']['nombre'] == $nombre &&
			trim(preg_replace('/\s+/', ' ', strtolower($data['reward']['descripcion']))) === trim(preg_replace('/\s+/', ' ', strtolower($descripcion)))&&
	    	$data['reward']['imagen'] == $imagen &&
	    	$data['reward']['idCat'] == $categoria &&
			$data['reward']['fecha'] == $fecha &&
			$data['reward']['precioBoleto'] == $precioBoleto &&
			$data['reward']['descripcionSorteo'] == $descripcionSorteo){
	    	$changes = false;}

		if($changes){
			$rewards->modifyReward($id,$nombre,$descripcion,$imagen,$categoria,$fecha,$precioBoleto,$descripcionSorteo);
			$this->rewards();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Premio modificado exitosamente',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/rewards';
				}, 1000);</script>";
		}else{
			$this->modifyReward($id);
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>Swal.fire({
		        icon: 'error',
		        title: 'Error',
		        text: 'No has modificado el premio'
		    }).then((result) => {
		        if (result.isConfirmed) {
		            window.location.href = '/admin/rewards';
		        }
		    });</script>";
		}
	}//end saveReward

	function categories(){
		//title
		$data['title'] = "Categorías";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		$catego = new Category_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		session_start();
		$_SESSION['categories'] = $catego->getCategories();
		require_once "views/app/admin/categories.php";
	}//end categories

	function newCategory(){
		//title
		$data['title'] = "Nueva Categoría";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		require_once "views/app/admin/newCategory.php";
	}//end newCategory

	function addCategory(){
		//model instance
		$catego = new Category_model;
		//form data
		$category = $_POST['category'];
		//
		$catego->saveCategory($category);
		$this->categories();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Categoria agregada exitosamente',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/categories';
				}, 1000);</script>";
	}//end addCategory

	function modifyCategory($id){
		//title
		$data['title'] = "Modificar Categoría";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		$catego = new Category_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//
		session_start();
		$_SESSION['modifyCategory'] = $catego->getCategory($id);
		require_once "views/app/admin/modifyCategory.php";
	}//end modifyCategory

	function saveCategory(){
		//model instance
		$catego = new Category_model;
		//form data
		$id = $_POST['idCategory'];
		$category = $_POST['category'];
		//verify if category isn't modify
		$data['category'] = $catego->getCategory($id);
		if($data['category']['descripcionCatego'] == $category){
			$this->modifyCategory($id);
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>Swal.fire({
		        icon: 'error',
		        title: 'Error',
		        text: 'No has modificado la Categoría'
		    }).then((result) => {
		        if (result.isConfirmed) {
		            window.location.href = '/admin/categories';
		        }
		    });</script>";
		}else{
			$catego->modifyCategory($id,$category);
			//header("Location: categories");
			$this->categories();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Categoria modificada exitosamente',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/categories';
				}, 1000);</script>";
		}
	}//end saveCategory

	function deleteCategory($id){
		//model instance
		$catego = new Category_model;
		//redirection
		$catego->deleteCategory($id);
		header("Location: ../categories");
	}//end deleteCategory

	function participants(){
		//title
		$data['title'] = "Participantes";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		$users = new Users_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//
		session_start();
		$_SESSION['participants'] = $users->getParticipants();
		require_once "views/app/admin/participants.php";
	}//end participants

	function profile(){
		//title
		$data['title'] = "Perfil";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		$users = new Users_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//
		$estado_session = session_status();
		if($estado_session == PHP_SESSION_NONE){session_start();}
		$id = $_SESSION['Admin']['id'];
		$data['profile'] = $users->getUser($id);
		require_once "views/app/admin/profile.php";
	}//end profile

	function changeProfile(){
		//title
		$data['title'] = "Modificar Perfil";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		$users = new Users_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//
		$estado_session = session_status();
		if($estado_session == PHP_SESSION_NONE){session_start();}
		$id = $_SESSION['Admin']['id'];
		$data['user'] = $users->getUser($id);
		require_once "views/app/admin/modifyProfile.php";
	}//end changeProfile

	function saveProfile(){
		//model instance
		$users = new Users_model;
		$ec = new EncodedController;
		//form data
		$id = $_POST['id'];
		$nombre = $_POST['name'];
		$apaterno = $_POST['psurname'];
		$amaterno = $_POST['msurname'];
		$usuario = $_POST['user'];
		$correo = $_POST['mail'];
		$telefono = $_POST['phone'];
		//
		$data['user'] = $users->getUser($id);
		$changes = true;
		if($ec->decrypt($data['user']['nombre']) == $nombre)
			if($ec->decrypt($data['user']['apaterno']) == $apaterno)
				if($ec->decrypt($data['user']['amaterno']) == $amaterno)
					if($data['user']['usuario'] == $usuario)
						if($ec->decrypt($data['user']['correo']) == $correo)
							if($ec->decrypt($data['user']['telefono']) == $telefono)
								$changes = false;

		if($changes){
			$_nombre = $ec->encrypt($nombre);
			$_apaterno = $ec->encrypt($apaterno);
			$_amaterno = $ec->encrypt($amaterno);
			$_correo = $ec->encrypt($correo);
			$_telefono = $ec->encrypt($telefono);
			$users->modifyUser($id,$_nombre,$_apaterno,$_amaterno,$usuario,$_correo,$_telefono);
			$this->profile();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Perfil modificado exitosamente',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/profile';
				}, 1000);</script>";
		}else{
			$this->changeProfile($id);
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>Swal.fire({
		        icon: 'error',
		        title: 'Error',
		        text: 'No has modificado tu perfil'
		    }).then((result) => {
		        if (result.isConfirmed) {
		            window.location.href = '/admin/profile';
		        }
		    });</script>";
		}
	}//end saveProfile

	function changePassword(){
		//title
		$data['title'] = "Modificar Perfil";
		//model instance
		$rewards = new Rewards_model;
		$count = new Counters_model;
		$users = new Users_model;
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		//Counts for aside menu
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		//
		$estado_session = session_status();
		if($estado_session == PHP_SESSION_NONE){session_start();}
		$id = $_SESSION['Admin']['id'];
		$data['user'] = $users->getUser($id);
		require_once "views/app/admin/changePassword.php";
	}//changePassword

	function savePassword(){
		//model instance
		$users = new Users_model;
		$ec = new EncodedController;
		//form data
		$id = $_POST['id'];
		$oldpass = $_POST['oldpass'];
		$newpass = $_POST['newpass'];
		$pass = $_POST['pass'];
		$data['user'] = $users->getUser($id);
		$contrasena = ($ec->decrypt($data['user']['contrasena'])==null) ? $data['user']['contrasena'] : $ec->decrypt($data['user']['contrasena']);

		if($oldpass != $contrasena){
			$this->changePassword();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>Swal.fire({
		        icon: 'error',
		        title: 'Error',
		        text: 'La contraseña antigua es incorrecta'
		    }).then((result) => {
		        if (result.isConfirmed) {
		            window.location.href = '/admin/changepassword';
		        }
		    });</script>";
		}else{
			if($newpass != $pass){
				$this->changePassword();
				echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
				echo "<script>Swal.fire({
			        icon: 'error',
			        title: 'Error',
			        text: 'La nueva contraseña y la contraseña de verificación no coinciden.'
			    }).then((result) => {
			        if (result.isConfirmed) {
			            window.location.href = '/admin/changepassword';
			        }
			    });</script>";
			}else{
				if($newpass != $oldpass){
				$users-> changePass($ec->encrypt($newpass),$id);
				$this->changePassword();
				echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
				echo "<script>
					Swal.fire({
					  icon: 'success',
					  title: 'Se cambio la contraseña exitosamente.',
					   showConfirmButton: false,
					  timer: 3500
					});
					setTimeout(() => {
					  window.location.href = '/admin/profile';
					}, 1000);</script>";
				}else{
					$this->changePassword();
					echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
					echo "<script>Swal.fire({
				        icon: 'error',
				        title: 'Error',
				        text: 'La nueva contraseña no puede ser la misma que la antigua.'
				    }).then((result) => {
				        if (result.isConfirmed) {
				            window.location.href = '/admin/changepassword';
				        }
				    });</script>";
				}
			}
		}
	}//end savePassword

	function changeImagesReward(){
		//title
		$data['title'] = "Cambiar Imagen del Premio";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		//Counts for aside menu
		$data['users'] = $count->countUsers();
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		$data['categories'] = $count->countCategories();
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		require_once "views/app/admin/changeImagesReward.php";
	}//end changeImagesReward

	function saveimagesreward(){
		//model instance
		$rewards = new Rewards_model;
		//form data
		$id = $_POST['id'];
		//
		if( isset($_FILES['imagen']) ){
			//Obtiene la informacion del archivo seleccionado
			$file = $_FILES['imagen'];
			$filename = $file["name"];
			$mimetype = $file["type"];
			$name = $file['tmp_name'];
			//Verifica el tipo de archivo seleccionado
			$allowed_files = array("image/jpg", "image/jpeg", "image/png");
			if( !in_array($mimetype, $allowed_files) ){
				header("Location: rewards");
			}
			//Crea el directorio si no existe
			if( !is_dir("assets/media/premios") ){
				mkdir("assets/media/premios",0777);
			}
			//Mueve el archivo a la carpeta del directorio
			$urlCompleta = "assets/media/premios/" . $filename;
			if( !file_exists($urlCompleta) ){
				$rewards->saveImage($urlCompleta);
				move_uploaded_file($name, $urlCompleta);
			}
			$rewards->updateRewardsImage($id,$urlCompleta);
			$this->rewards();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Se actualizó la imagen del premio exitosamente.',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/rewards';
				}, 1000);</script>";
		}
	}//end saveimagesreward

	function changeProfilePhoto(){
		//title
		$data['title'] = "Cambiar Imagen de Usuario";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		$users = new Users_model;
		//Counts for aside menu
		$data['users'] = $count->countUsers();
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		$data['categories'] = $count->countCategories();
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$estado_session = session_status();
		if($estado_session == PHP_SESSION_NONE){session_start();}
		$id = $_SESSION['Admin']['id'];
		$data['user'] = $users->getUser($id);
		require_once "views/app/admin/changeImagesUser.php";
	}//end changeProfilePhoto

	function saveprofilephoto(){
		//model instance
		$users = new Users_model;
		//form data
		$id = $_POST['id'];
		//
		if( isset($_FILES['imagen']) ){
			//Obtiene la informacion del archivo seleccionado
			$file = $_FILES['imagen'];
			$filename = $file["name"];
			$mimetype = $file["type"];
			$name = $file['tmp_name'];
			//Verifica el tipo de archivo seleccionado
			$allowed_files = array("image/jpg", "image/jpeg", "image/png");
			if( !in_array($mimetype, $allowed_files) ){
				header("Location: profile");
			}
			//Crea el directorio si no existe
			if( !is_dir("assets/media/".$id) ){
				mkdir("assets/media/".$id,0777);
			}
			//Mueve el archivo a la carpeta del directorio
			$urlCompleta = "assets/media/".$id."/" . $filename;
			if( !file_exists($urlCompleta) ){
				move_uploaded_file($name, $urlCompleta);
			}
			$users->updateProfilePhoto($id,$urlCompleta);
			$this->profile();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Se actualizó la imagen de perfil exitosamente.',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/profile';
				}, 1000);</script>";
		}
	}//end saveprofilephoto

	function config(){
		//title
		$data['title'] = "Configuración de Inicio";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		$config = new Config_model;
		//Counts for aside menu
		$data['users'] = $count->countUsers();
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		$data['categories'] = $count->countCategories();
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$data['config'] = $config->getData();
		require_once "views/app/admin/configuration.php";
	}//end config

	function changeImagesPage(){
		//title
		$data['title'] = "Cambiar Imagen de la Pagina";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		$config = new Config_model;
		//Counts for aside menu
		$data['users'] = $count->countUsers();
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		$data['categories'] = $count->countCategories();
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$estado_session = session_status();
		if($estado_session == PHP_SESSION_NONE){session_start();}
		$data['config'] = $config->getData();
		require_once "views/app/admin/changeImagesPage.php";
	}//end changeImagesPage

	function saveImagePage(){
		//model instance
		$config = new Config_model;
		//form data
		$id = $_POST['id'];
		//
		if( isset($_FILES['imagen']) ){
			//Obtiene la informacion del archivo seleccionado
			$file = $_FILES['imagen'];
			$filename = $file["name"];
			$mimetype = $file["type"];
			$name = $file['tmp_name'];
			//Verifica el tipo de archivo seleccionado
			$allowed_files = array("image/jpg", "image/jpeg", "image/png");
			if( !in_array($mimetype, $allowed_files) ){
				header("Location: config");
			}
			//Crea el directorio si no existe
			if( !is_dir("assets/media/") ){
				mkdir("assets/media/",0777);
			}
			//Mueve el archivo a la carpeta del directorio
			$urlCompleta = "assets/media/" . $filename;
			if( !file_exists($urlCompleta) ){
				move_uploaded_file($name, $urlCompleta);
			}
			$config->changeImage($urlCompleta);
			$this->config();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Se actualizó la imagen de la pagina exitosamente.',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/config';
				}, 1000);</script>";
		}
	}//end saveImagePage

	function changeColors(){
		//title
		$data['title'] = "Cambiar Colores de la Pagina";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		$config = new Config_model;
		//Counts for aside menu
		$data['users'] = $count->countUsers();
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		$data['categories'] = $count->countCategories();
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$estado_session = session_status();
		if($estado_session == PHP_SESSION_NONE){session_start();}
		$data['config'] = $config->getData();
		require_once "views/app/admin/changeColors.php";
	}//end changeColors

	function saveColors(){
		//model instance
		$config = new Config_model;
		//form data
		$imgbgrgb = $_POST['imgbgrgb'];
		$imgbgrgba = $_POST['imgbgrgba'];
		$menubgrgb = $_POST['menubgrgb'];
		$menubgrgba = $_POST['menubgrgba'];
		//
		$config->changeColors($imgbgrgb,$imgbgrgba,$menubgrgb,$menubgrgba);
		$this->config();
		echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
		echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Se cambiaron los colores de la pagina exitosamente.',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/config';
				}, 1000);</script>";
	}//end saveColors

	function company(){
		//title
		$data['title'] = "Configuración de Empresa";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		$config = new Config_model;
		//Counts for aside menu
		$data['users'] = $count->countUsers();
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		$data['categories'] = $count->countCategories();
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$data['config'] = $config->getData();
		require_once "views/app/admin/company.php";
	}//end company

	function changeLogo(){
		//title
		$data['title'] = "Cambiar Logo";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		$config = new Config_model;
		//Counts for aside menu
		$data['users'] = $count->countUsers();
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		$data['categories'] = $count->countCategories();
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$data['config'] = $config->getData();
		require_once "views/app/admin/changeLogo.php";
	}//end changeLogo

	function saveLogo(){
		//model instance
		$config = new Config_model;
		//
		if( isset($_FILES['imagen']) ){
			//Obtiene la informacion del archivo seleccionado
			$file = $_FILES['imagen'];
			$filename = $file["name"];
			$mimetype = $file["type"];
			$name = $file['tmp_name'];
			//Verifica el tipo de archivo seleccionado
			$allowed_files = array("image/jpg", "image/jpeg", "image/png");
			if( !in_array($mimetype, $allowed_files) ){
				header("Location: company");
			}
			//Crea el directorio si no existe
			if( !is_dir("assets/media/") ){
				mkdir("assets/media/",0777);
			}
			//Mueve el archivo a la carpeta del directorio
			$urlCompleta = "assets/media/" . $filename;
			if( !file_exists($urlCompleta) ){
				move_uploaded_file($name, $urlCompleta);
			}
			$config->changeLogo($urlCompleta);
			$this->company();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Se actualizó el logo exitosamente.',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/company';
				}, 1000);</script>";
		}
	}//end saveLogo

	function nameCompany(){
		//title
		$data['title'] = "Configuración de Empresa";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		$config = new Config_model;
		//Counts for aside menu
		$data['users'] = $count->countUsers();
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		$data['categories'] = $count->countCategories();
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$data['config'] = $config->getData();
		require_once "views/app/admin/namecompany.php";
	}//end nameCompany

	function saveName(){
		//model instance
		$config = new Config_model;
		//form data
		$name = $_POST['namecompany'];
		//verify if category isn't modify
		$data['company'] = $config->getData();
		if($data['company']['empresa'] == $name){
			$this->nameCompany();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>Swal.fire({
		        icon: 'error',
		        title: 'Error',
		        text: 'No has modificado el nombre de la empresa'
		    }).then((result) => {
		        if (result.isConfirmed) {
		            window.location.href = '/admin/company';
		        }
		    });</script>";
		}else{
			$config->changeNameCompany($name);
			$this->company();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Nombre de la empresa modificado exitosamente',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/company';
				}, 1000);</script>";
		}
	}//end saveName

	function stripe(){
		//title
		$data['title'] = "Configuración Stripe";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		$config = new Config_model;
		$stripe = new Stripe_model;
		//Counts for aside menu
		$data['users'] = $count->countUsers();
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		$data['categories'] = $count->countCategories();
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$data['config'] = $config->getData();
		$data['publicKey'] = $stripe->getPublicKey();
		$data['privateKey'] = $stripe->getPrivateKey();
		require_once "views/app/admin/stripe.php";
	}//end stripe

	function modifyStripe(){
		//title
		$data['title'] = "Configuración Stripe";
		//model instance
		$count = new Counters_model;
		$rewards = new Rewards_model;
		$config = new Config_model;
		$stripe = new Stripe_model;
		//Counts for aside menu
		$data['users'] = $count->countUsers();
		$data['rewards'] = $count->countRewards();
		$data['pending'] = $count->countPendignRewards();
		$data['authorized'] = $count->countAuthorizedRewards();
		$data['rejected'] = $count->countRejectedRewards();
		$data['categories'] = $count->countCategories();
		//Verifiy if there is an active reward
		$data['active'] = ($rewards->getActiveReward()!=null) ? true : false;
		$data['config'] = $config->getData();
		$data['publicKey'] = $stripe->getPublicKey();
		$data['privateKey'] = $stripe->getPrivateKey();
		require_once "views/app/admin/modifyStripe.php";
	}

	function saveStripeKeys(){
		//model instance
		$stripe = new Stripe_model;
		//Form data
		$privateK = $_POST['privateKey'];
		$publicK = $_POST['publicKey'];
		//
		$data['publicKey'] = $stripe->getPublicKey();
		$data['privateKey'] = $stripe->getPrivateKey();

		$changes = false;

		if($publicK != $data['publicKey']['cpub'] ||
			$privateK != $data['privateKey']['cpriv']){
			$changes = true;
		}

		if($changes){
			$stripe->modifyKeys($publicK,$privateK);
			$this->stripe();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
				Swal.fire({
				  icon: 'success',
				  title: 'Claves modificadas exitosamente',
				   showConfirmButton: false,
				  timer: 3500
				});
				setTimeout(() => {
				  window.location.href = '/admin/stripe';
				}, 1000);</script>";
		}else{
			$this->stripe();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>Swal.fire({
		        icon: 'error',
		        title: 'Error',
		        text: 'No has modificado las claves'
		    }).then((result) => {
		        if (result.isConfirmed) {
		            window.location.href = '/admin/stripe';
		        }
		    });</script>";
		}
	}

}
?>