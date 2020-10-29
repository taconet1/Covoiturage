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
		return $liste;
	}

	public function getDepVil($id){
		$req=$this->db->prepare("SELECT vil_nom FROM ville v JOIN departement d ON v.vil_num=d.vil_num WHERE dep_num=$id");
		$req->execute();
		return $req->fetchColumn();
	}

	public function getDep($id){
		$req=$this->db->prepare("SELECT dep_nom FROM departement WHERE dep_num=$id");
		$req->execute();
		return $req->fetchColumn();
	}
}
?>
