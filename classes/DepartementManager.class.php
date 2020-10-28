<?php
class DepartementManager{
	private $db;

	public function __construct($db){
		$this->db=$db;
	}

	public function getAllDepartement(){
		$liste=array();
		$req=$this->db->prepare('SELECT dep_num, dep_nom, vil_num FROM departement');
		$req->execute();

		while ($departement = $req->fetch(PDO::FETCH_OBJ)) {
			$liste[]=new Departement($departement);
		}
		$req->closeCursor();

		return $liste;
	}

	public function getVilById($id){
		$req=$this->db->prepare('SELECT vil_nom FROM ville WHERE vil_num='.$id);
		$req->execute();
		$ville=$req->fetch()['vil_nom'];
		return $ville;
	}
}
?>
