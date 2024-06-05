<?php
class Stripe_model
{
	//variable for db and queries
	private $db;
	private $data;

	function __construct(){
		$this->db = Conectar::conexion();
	}

	public function getPrivateKey(){
		$sql = "SELECT claveprivada AS cpriv FROM stripe";
		$resultado = $this->db->query($sql);
		$row = $resultado->fetch_assoc();
		return $row;
	}

	public function getPublicKey(){
		$sql = "SELECT clavepublica AS cpub FROM stripe";
		$resultado = $this->db->query($sql);
		$row = $resultado->fetch_assoc();
		return $row;
	}

	public function modifyKeys($publicKey,$privateKey){
		$resultado = $this->db->query("UPDATE stripe SET clavepublica='$publicKey', claveprivada='$privateKey' WHERE id='1'");
	}

}
?>