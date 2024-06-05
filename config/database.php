<?php
	
	class Conectar {
		
		public static function conexion(){
			
			$conexion = new mysqli(SERVER, USER, PASSWORD, DATABASE);
			return $conexion;
			
		}
	}
?>