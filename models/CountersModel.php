<?php
class Counters_model
{
	//variable for db
	private $db;
	//constructor
	function __construct()
	{
		$this->db = Conectar::conexion();
	}
	//Count Users
		public function countUsers(){
			$sql = "SELECT COUNT(*) AS users FROM usuarios WHERE idTipoUsuario=2";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();
			return $row;
		}
		//Count Participants
		public function countParticipants(){
			$sql = "SELECT COUNT(*) AS participants FROM usuarios WHERE idTipoUsuario=3";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();
			return $row;
		}
		//Count All Rewards
		public function countRewards(){
			$sql = "SELECT COUNT(*) AS rewards FROM premios";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();
			return $row;
		}
		//Count Pending Rewards
		public function countPendignRewards(){
			$sql = "SELECT COUNT(*) AS pending FROM premios WHERE idEstado=1";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();
			return $row;
		}
		//Count Authorized Rewards
		public function countAuthorizedRewards(){
			$sql = "SELECT COUNT(*) AS authorized FROM premios WHERE idEstado=2";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();
			return $row;
		}
		//Count Rejected Rewards
		public function countRejectedRewards(){
			$sql = "SELECT COUNT(*) AS rejected FROM premios WHERE idEstado=3";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();
			return $row;
		}
		//Count Categories
		public function countCategories(){
			$sql = "SELECT COUNT(*) AS NumCatego FROM clasificaciones";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();
			return $row;
		}
}
?>