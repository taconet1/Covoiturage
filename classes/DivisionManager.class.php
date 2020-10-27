<?php
class DivisionManager{
	private $db;

	public function __construct($db){
		$this->db=$db;
	}

	public function getAllDivision(){
		$liste=array();

		$req=$this->db->prepare('SELECT div_num,div_nom FROM division');
		$req->execute();
		while ($a <= 10) {
			// code...
		}
	}
}
?>
