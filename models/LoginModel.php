<?php
	class Login_model
	{
		//variable for db
		private $db;
		//constructor
		function __construct(){
			$this->db = Conectar::conexion();
		}

		//get data user to verify login
		public function getUser($user){
			$sql = "SELECT * FROM usuarios WHERE usuario='$user' LIMIT 1";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();
			return $row;
		}

	}
?>