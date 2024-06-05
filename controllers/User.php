<?php
class UserController
{
	function __construct(){
		//Counters Model
		require_once "models/CountersModel.php";
		//User Model
		require_once "models/UsersModel.php";
		//Rewards Controller
		require_once "models/RewardsModel.php";
		//Category Controller
		require_once "models/CategoryModel.php";
		//Encoded Controller
		require_once "controllers/Encoded.php";
	}

	function index(){
		//title
		$data['title'] = "Inicio";
		//model instance
		$count = new Counters_model;
		//Counts for aside menu
		$data['participants'] = $count->countParticipants();
		$data['rewards'] = $count->countRewards();
		$data['categories'] = $count->countCategories();
		require_once "views/app/user/index.php";
	}//end index

	function categories(){
		//title
		$data['title'] = "Categorías";
		//model instance
		$catego = new Category_model;
		//
		session_start();
		$_SESSION['categories'] = $catego->getCategories();
		require_once "views/app/user/categories.php";
	}//end categories

	function newCategory(){
		//title
		$data['title'] = "Nueva Categoría";
		//
		require_once "views/app/user/newCategory.php";
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
				  window.location.href = '/user/categories';
				}, 1000);</script>";
	}//end addCategory

	function modifyCategory($id){
		//title
		$data['title'] = "Modificar Categoría";
		//model instance
		$catego = new Category_model;
		//
		session_start();
		$_SESSION['modifyCategory'] = $catego->getCategory($id);
		require_once "views/app/user/modifyCategory.php";
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
		            window.location.href = '/user/categories';
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
				  window.location.href = '/user/categories';
				}, 1000);</script>";
		}
	}//end saveCategory

	function deleteCategory($id){
		//model instance
		$catego = new Category_model;
		//
		$catego->deleteCategory($id);
		header("Location: ../categories");
	}//end deleteCategory

	function rewards(){
		//title
		$data['title'] = "Premios";
		//model instance
		$rewards = new Rewards_model;
		//
		session_start();
		$_SESSION['rewards'] = $rewards->getRewards();
		require_once "views/app/user/rewards.php";
	}//end rewards

	function newReward(){
		//title
		$data['title'] = "Nuevo Premio";
		//model instance
		$catego = new Category_model;
		//
		session_start();
		$_SESSION['categoriestorewards'] = $catego->getCategories();
		if($_SESSION['categoriestorewards'] == null){
			require_once "views/app/user/categories.php";
			$this->rewards();
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>Swal.fire({
			  title: 'Primero agrega una categoría',
			  icon: 'warning',
			  showConfirmButton: false,
			  timer: 2000,
			  timerProgressBar: true,
			}).then(() => {
			  window.location.href = '/user/categories';
			});</script>";
		}else{
			require_once "views/app/user/newReward.php";
		}
	}//end newReward

	function addReward(){
		//model instance
		$rewards = new Rewards_model;
		//form data
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
				  window.location.href = '/user/rewards';
				}, 1000);</script>";
	}//end addReward

	function modifyReward($id){
		//title
		$data['title'] = "Modificar Premio";
		//model instance
		$catego = new Category_model;
		$rewards = new Rewards_model;
		//
		session_start();
		$_SESSION['categoriestorewards'] = $catego->getCategories();
		$_SESSION['reward'] = $rewards->getReward($id);
		require_once "views/app/user/modifyReward.php";
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
		//
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
				  window.location.href = '/user/rewards';
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
		            window.location.href = '/user/rewards';
		        }
		    });</script>";
		}
	}//end saveReward

	function deleteReward($id){
		//model instance
		$rewards = new Rewards_model;
		//
		$rewards->deleteReward($id);
		header("Location: ../rewards");
	}//end deleteReward

	function profile(){
		//title
		$data['title'] = "Perfil";
		//model instance
		$users = new Users_model;
		//
		$estado_session = session_status();
		if($estado_session == PHP_SESSION_NONE){session_start();}
		$id = $_SESSION['User']['id'];
		$data['profile'] = $users->getUser($id);
		require_once "views/app/user/profile.php";
	}//end profile

	function changeProfile(){
		//title
		$data['title'] = "Modificar Perfil";
		//model instance
		$users = new Users_model;
		//
		$estado_session = session_status();
		if($estado_session == PHP_SESSION_NONE){session_start();}
		$id = $_SESSION['User']['id'];
		$data['user'] = $users->getUser($id);
		require_once "views/app/user/modifyProfile.php";
	}//end changeprofile

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
				  window.location.href = '/user/profile';
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
		            window.location.href = '/user/profile';
		        }
		    });</script>";
		}
	}//end saveprofile

	function changePassword(){
		//title
		$data['title'] = "Modificar Perfil";
		//model instance
		$users = new Users_model;
		//
		$estado_session = session_status();
		if($estado_session == PHP_SESSION_NONE){session_start();}
		$id = $_SESSION['User']['id'];
		$data['user'] = $users->getUser($id);
		require_once "views/app/user/changePassword.php";
	}//end changepassword

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
		            window.location.href = '/user/changepassword';
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
			            window.location.href = '/user/changepassword';
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
					  window.location.href = '/user/profile';
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
				            window.location.href = '/user/changepassword';
				        }
				    });</script>";
				}
			}
		}
	}//end savepassword

	function changeImagesReward(){
		//title
		$data['title'] = "Cambiar Imagen del Premio";
		//
		require_once "views/app/user/changeImagesReward.php";
	}//end changeImagesReward

	function saveImagesReward(){
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
				  window.location.href = '/user/rewards';
				}, 1000);</script>";
		}
	}//end saveImagesReward

	function changeProfilePhoto(){
		//title
		$data['title'] = "Cambiar Imagen de Usuario";
		//model instance
		$users = new Users_model;
		$estado_session = session_status();
		if($estado_session == PHP_SESSION_NONE){session_start();}
		$id = $_SESSION['User']['id'];
		$data['user'] = $users->getUser($id);
		require_once "views/app/user/changeImagesUser.php";
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
				  window.location.href = '/user/profile';
				}, 1000);</script>";
		}
	}//end saveprofilephoto

	function participants(){
		//title
		$data['title'] = "Participantes";
		//model instance
		$users = new Users_model;
		//
		session_start();
		$_SESSION['participants'] = $users->getParticipants();
		require_once "views/app/user/participants.php";
	}//end participants
}
?>