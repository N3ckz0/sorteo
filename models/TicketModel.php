<?php
class Ticket_model
{
	private $db;
	private $nums;
	//constructor
	function __construct()
	{
		$this->db = Conectar::conexion();
	}
	//Add new participant
	public function saveParticipant($nombre,$apaterno,$amaterno,$correo,$telefono){
		$resultado = $this->db->query("INSERT INTO usuarios (nombre,apaterno,amaterno,correo,telefono,idTipoUsuario) VALUES ('$nombre','$apaterno','$amaterno','$correo','$telefono',3)");
		$sql = "SELECT LAST_INSERT_ID() AS id";
		$res = $this->db->query($sql);
		$row = $res->fetch_assoc();
		return $row;
	}
	//Add a register of Tickets
	public function saveSoldTicket($numero,$idUsuario,$idPago,$idPremio){
		$resultado = $this->db->query("INSERT INTO ventas (numero,idParticipant,idTicket,idPremio) VALUES ('$numero','$idUsuario','$idPago','$idPremio')");
	}
	//Get registred numbers
	public function getNumbers(){
		$sql = "SELECT numero FROM ventas";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc()){
			$this->nums[] = $row;
		}
		return $this->nums;
	}
}
?>