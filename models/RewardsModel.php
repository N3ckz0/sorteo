<?php
class Rewards_model
{
	//variable for db
	private $db;
	private $premios;
	//constructor
	function __construct(){
		$this->db = Conectar::conexion();
	}

	//Get the active reward
	public function getActiveReward(){
		$sql = "SELECT p.id,p.nombre,p.descripcion,p.imagen,p.actived,p.fecha,p.precioBoleto,p.descripcionSorteo,e.estado,c.descripcionCatego
						FROM premios AS p
						INNER JOIN estadoPremios AS e ON p.idEstado = e.id
						INNER JOIN clasificaciones AS c ON p.idClasificacion = c.id
						WHERE p.actived = 1 LIMIT 1";
		$resultado = $this->db->query($sql);
		$row = $resultado->fetch_assoc();
		return $row;
	}

	//Get authorized rewards
	public function getAuthorizedRewards(){
		$sql = "SELECT p.id,p.nombre,p.descripcion,p.imagen,p.actived,p.fecha,p.precioBoleto,p.descripcionSorteo,e.estado,c.descripcionCatego
					FROM premios AS p
					INNER JOIN estadoPremios AS e ON p.idEstado = e.id
					INNER JOIN clasificaciones AS c ON p.idClasificacion = c.id
					WHERE idEstado = 2";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc()){
			$this->premios[] = $row;
		}
		return $this->premios;
	}

	//Get Rejected Rewards
	public function getRejectedRewards(){
		$sql = "SELECT p.id,p.nombre,p.descripcion,p.imagen,p.actived,p.fecha,p.precioBoleto,p.descripcionSorteo,e.estado,c.descripcionCatego
					FROM premios AS p
					INNER JOIN estadoPremios AS e ON p.idEstado = e.id
					INNER JOIN clasificaciones AS c ON p.idClasificacion = c.id
					WHERE idEstado = 3";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc()){
			$this->premios[] = $row;
		}
		return $this->premios;
	}

	//Get Pending Rewards
	public function getPendingRewards(){
		$sql = "SELECT p.id,p.nombre,p.descripcion,p.imagen,p.actived,p.fecha,p.precioBoleto,p.descripcionSorteo,e.estado,c.descripcionCatego
					FROM premios AS p
					INNER JOIN estadoPremios AS e ON p.idEstado = e.id
					INNER JOIN clasificaciones AS c ON p.idClasificacion = c.id
					WHERE idEstado = 1";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc()){
			$this->premios[] = $row;
		}
		return $this->premios;
	}

	//Change status of reward to authorized
	public function authorizeReward($id){
		$res = $this->db->query("UPDATE premios SET idEstado=2  WHERE id='$id'");
	}

	//Change status of reward to rejected
	public function denyReward($id){
		$res = $this->db->query("UPDATE premios SET idEstado=3  WHERE id='$id'");
	}

	//Change status of reward to active
	public function activeReward($id){
		$res = $this->db->query("UPDATE premios SET actived=true  WHERE id='$id'");
	}

	//Change status of reward to disabled
	public function disableReward($id){
		$res = $this->db->query("UPDATE premios SET actived=false  WHERE id='$id'");
	}

	//Get rewards
	public function getRewards(){
		$sql = "SELECT p.id,p.nombre,p.descripcion,p.imagen,p.actived,p.fecha,p.precioBoleto,p.fecha,p.descripcionSorteo,e.estado,c.descripcionCatego
						FROM premios AS p
						INNER JOIN estadoPremios AS e ON p.idEstado = e.id
						INNER JOIN clasificaciones AS c ON p.idClasificacion = c.id";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc()){
			$this->premios[] = $row;
		}
		return $this->premios;
	}

	//Get a reward by ID
	public function getReward($id){
		$sql = "SELECT p.id,p.nombre,p.descripcion,p.imagen,p.actived,p.fecha,p.precioBoleto,p.descripcionSorteo,e.estado,c.id as idCat,c.descripcionCatego
						FROM premios AS p
						INNER JOIN estadoPremios AS e ON p.idEstado = e.id
						INNER JOIN clasificaciones AS c ON p.idClasificacion = c.id
						WHERE p.id='$id' LIMIT 1";
		$resultado = $this->db->query($sql);
		$row = $resultado->fetch_assoc();
		return $row;
	}

	//Delete a reward
	public function deleteReward($id){
		$resultado = $this->db->query("DELETE FROM premios WHERE id = '$id'");
	}

	//Save an image
	public function saveImage($url){
		$resultado = $this->db->query("INSERT INTO imagenes (url) VALUES ('$url')");
	}

	//Save the reward on database
	public function saveReward($nombre,$descripcion,$imagen,$categoria,$fecha,$precioBoleto,$descripcionSorteo){
		$resultado = $this->db->query("INSERT INTO premios (nombre,descripcion,imagen,actived,fecha,precioBoleto,descripcionSorteo,idEstado,idClasificacion) VALUES ('$nombre','$descripcion','$imagen',false,'$fecha','$precioBoleto','$descripcionSorteo',1,'$categoria')");
	}

	//Modify a reward
	public function modifyReward($id,$nombre,$descripcion,$imagen,$categoria,$fecha,$precioBoleto,$descripcionSorteo){
		$res = $this->db->query("UPDATE premios SET nombre='$nombre', descripcion='$descripcion', imagen='$imagen', idClasificacion='$categoria', fecha='$fecha', precioBoleto='$precioBoleto', descripcionSorteo='$descripcionSorteo' WHERE id='$id'");
	}

	public function updateRewardsImage($id,$imagen){
		$res = $this->db->query("UPDATE premios SET imagen='$imagen' WHERE id='$id'");
	}
}
?>