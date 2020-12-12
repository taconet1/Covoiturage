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

	public function supprimerById($id) {
    $req=$this->db->prepare('DELETE FROM etudiant WHERE per_num=:per_num');
    $req->bindValue(':per_num',$id);
    return $req->execute();
  }

	public function modifierDetails($etudiant) {
		$req=$this->db->prepare('UPDATE etudiant SET dep_num=:dep_num, div_num=:div_num WHERE per_num=:per_num');
		$req->bindValue(':dep_num', $etudiant->getDepNum());
		$req->bindValue(':div_num', $etudiant->getDivNum());
		$req->bindValue(':per_num', $etudiant->getPerNum());
		var_dump($etudiant);
		return $req->execute();
	}

	public function supprimer($etudiant){
    $req=$this->db->prepare('DELETE FROM salarie WHERE per_num = '.$etudiant);
    $req->execute();
  }
}
?>
