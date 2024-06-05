<?php
class Config_model
{
	//variable for db and queries
	private $db;
	private $data;

	function __construct(){
		$this->db = Conectar::conexion();
	}

	public function getData(){
		$sql = "SELECT * FROM config WHERE id =1";
		$resultado = $this->db->query($sql);
		$row = $resultado->fetch_assoc();
		return $row;
	}

	public function changeImage($img){
		$resultado = $this->db->query("UPDATE config SET imgfondo='$img' WHERE id=1");
	}

	public function changeColors($imgbgrgb,$imgbgrgba,$menubgrgb,$menubgrgba){
		$resultado = $this->db->query("UPDATE config SET colorfondo='$imgbgrgb', fondodegradado='$imgbgrgba', colormenu='$menubgrgb', menudegradado='$menubgrgba' WHERE id=1");
	}

	public function changeLogo($img){
		$resultado = $this->db->query("UPDATE config SET logo='$img' WHERE id=1");
	}

	public function changeNameCompany($name){
		$resultado = $this->db->query("UPDATE config SET empresa='$name' WHERE id=1");
	}

}
?>