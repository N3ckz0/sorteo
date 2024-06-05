<?php
class Users_model
{
	//variable for db
	private $db;
	private $users;

	function __construct(){
		$this->db = Conectar::conexion();
	}

	//Get Super Users
	public function getUsers(){
		$sql = "SELECT * FROM usuarios WHERE idTipoUsuario=2";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc()){
			$this->users[] = $row;
		}
		return $this->users;
	}

	//Add new user
	public function saveUser($nombre,$apaterno,$amaterno,$usuario,$correo,$telefono,$contrasena){
		$resultado = $this->db->query("INSERT INTO usuarios (nombre,apaterno,amaterno,usuario,correo,telefono,imagen,contrasena,idTipoUsuario) VALUES ('$nombre','$apaterno','$amaterno','$usuario','$correo','$telefono','assets/dist/img/user2-160x160.jpg','$contrasena',2)");
	}

	//Get an User by ID
	public function getUser($id){
		$sql = "SELECT * FROM usuarios WHERE id='$id' LIMIT 1";
		$resultado = $this->db->query($sql);
		$row = $resultado->fetch_assoc();
		return $row;
	}

	//Modify an user
	public function modifyUser($id,$nombre,$apaterno,$amaterno,$usuario,$correo,$telefono){
		$res = $this->db->query("UPDATE usuarios SET nombre='$nombre', apaterno='$apaterno', amaterno='$amaterno', usuario='$usuario', correo='$correo', telefono='$telefono' WHERE id='$id'");
	}

	//Delete an User
	public function deleteUser($id){
		$resultado = $this->db->query("DELETE FROM usuarios WHERE id = '$id'");
	}

	//Get Participants
	public function getParticipants(){
		$sql = "SELECT u.nombre, u.apaterno, u.amaterno, u.correo, u.telefono, v.idTicket, v.numero, p.nombre as pn
					FROM ventas AS v
					INNER JOIN usuarios AS u ON v.idParticipant = u.id
					INNER JOIN premios AS p ON v.idPremio = p.id
					WHERE u.idTipoUsuario = 3";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc()){
			$this->users[] = $row;
		}
		return $this->users;
	}

	//Change the password of user
	public function changePass($pass,$id){
		$res = $this->db->query("UPDATE usuarios SET contrasena='$pass'  WHERE id='$id'");
	}

	public function updateProfilePhoto($id,$imagen){
		$res = $this->db->query("UPDATE usuarios SET imagen='$imagen'  WHERE id='$id'");
	}

}
?>