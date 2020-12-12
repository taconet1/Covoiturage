<?php
class EtudiantManager{
	private $db;

	public function __construct($db){
		$this->db=$db;
	}

	public function ajouter($etudiant){
		$req=$this->db->prepare('INSERT INTO etudiant(per_num, dep_num, div_num) VALUES(:per_num, :dep_num, :div_num)');
		$req->bindValue(':per_num',$etudiant->getPerNum());
		$req->bindValue(':dep_num',$etudiant->getDepNum());
		$req->bindValue(':div_num',$etudiant->getDivNum());
		return $req->execute();
	}
	public function supprimer($etudiant){
    $req=$this->db->prepare('DELETE FROM salarie WHERE per_num = '.$etudiant);
    $req->execute();
  }
}
?>
