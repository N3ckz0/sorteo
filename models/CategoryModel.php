<?php
class Category_model
{
	//variable for db and queries
	private $db;
	private $categories;

	function __construct(){
		$this->db = Conectar::conexion();
	}

	//Get all categories
	public function getCategories(){
		$sql = "SELECT * FROM clasificaciones";
		$resultado = $this->db->query($sql);
		while($row = $resultado->fetch_assoc()){
			$this->categories[] = $row;
		}
		return $this->categories;
	}
	//Add a new category
	public function saveCategory($category){
		$resultado = $this->db->query("INSERT INTO clasificaciones (descripcionCatego) VALUES ('$category')");
	}
	//Get a category by ID
	public function getCategory($id){
		$sql = "SELECT * FROM clasificaciones WHERE id='$id' LIMIT 1";
		$resultado = $this->db->query($sql);
		$row = $resultado->fetch_assoc();
		return $row;
	}
	//Modify a category
	public function modifyCategory($id,$category){
		$resultado = $this->db->query("UPDATE clasificaciones SET descripcionCatego='$category' WHERE id='$id'");
	}
	//Delete a category
	public function deleteCategory($id){
		$resultado = $this->db->query("DELETE FROM clasificaciones WHERE id = '$id'");
	}
	//
}
?>