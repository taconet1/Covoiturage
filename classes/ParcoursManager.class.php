<?php
class ParcoursManager{
	private $db;
	public function __construct($db){
		$this->db = $db;
	}
	public function add($parcours){
		$requete = $this->db->prepare(
						'INSERT INTO parcours (par_km, vil_num1,vil_num2) VALUES (:kilometre, :ville1, :ville2);');

  	$requete->bindValue(':kilometre',$parcours->getKilometre());
						$requete->bindValue(':ville1',$parcours->getVille1());
						$requete->bindValue(':ville2',$parcours->getVille2());


            $retour=$requete->execute();

						return $retour;
	}

	public function nombre(){
		$sql = 'SELECT count(par_num) FROM parcours';
		$requete = $this->db->prepare($sql);
    $requete->execute();
		$total = $requete -> fetchColumn();
		$requete->closeCursor();
		return $total;
	}

	public function getAllParcours(){
		$listeParcours = array();
		$sql = 'SELECT par_num, v1.vil_nom as ville1, v2.vil_nom as ville2, par_km FROM parcours p JOIN ville v1 ON p.vil_num1=v1.vil_num JOIN ville v2 ON p.vil_num2= v2.vil_num';
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($parcours = $requete->fetch())
	    {  $listeParcours[] = $parcours;}
			$requete->closeCursor();
			return $listeParcours;
		}
}
