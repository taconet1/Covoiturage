<?php
class ParcoursManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function ajouter($parcours){
		$requete=$this->db->prepare('INSERT INTO parcours (par_km, vil_num1,vil_num2) VALUES (:par_km, :ville1, :ville2);');
		$requete->bindValue(':par_km',$parcours->getParKm());
		$requete->bindValue(':ville1',$parcours->getVilNum1());
		$requete->bindValue(':ville2',$parcours->getVilNum2());
    $resultat=$requete->execute();
		return $resultat;
	}

	public function existe($vil_num1, $vil_num2){
		$req=$this->db->prepare('SELECT par_num FROM parcours WHERE vil_num1=? and vil_num2=? UNION SELECT par_num FROM parcours WHERE vil_num1=? and vil_num2=?');
		$req->bindValue(1,$vil_num1,PDO::PARAM_STR);
		$req->bindValue(2,$vil_num2,PDO::PARAM_STR);
		$req->bindValue(3,$vil_num2,PDO::PARAM_STR);
		$req->bindValue(4,$vil_num1,PDO::PARAM_STR);
		$req->execute();
		return $req->rowCount();
	}

	public function getNombreParcours(){
		$requete=$this->db->prepare('SELECT COUNT(par_num) FROM parcours');
    $requete->execute();
		$nombreParcours=$requete->fetchColumn();
		$requete->closeCursor();
		return $nombreParcours;
	}

	public function getAllParcours(){
		$listeParcours=array();
		$sql='SELECT par_num, v1.vil_nom AS vil_num1, v2.vil_nom AS vil_num2, par_km FROM parcours p JOIN ville v1 ON p.vil_num1=v1.vil_num JOIN ville v2 ON p.vil_num2= v2.vil_num';
		$requete=$this->db->prepare($sql);
		$requete->execute();

		while ($parcours=$requete->fetch(PDO::FETCH_OBJ)){
			$listeParcours[]=new Parcours($parcours);
		}
		$requete->closeCursor();
		return $listeParcours;
	}
}
