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
    $req->execute();
  }

	public function modifierDetails($etudiant) {
		$req=$this->db->prepare('UPDATE etudiant SET dep_num=:dep_num, div_num=:div_num WHERE per_num=:per_num');
		$req->bindValue(':dep_num', $etudiant->getDepNum());
		$req->bindValue(':div_num', $etudiant->getDivNum());
		$req->bindValue(':per_num', $etudiant->getPerNum());
		return $req->execute();
	}

	public function getEtudiant($id){
		$req=$this->db->prepare("SELECT p.per_num, per_nom, per_prenom, per_mail, per_tel, dep_num, div_num, per_login, per_pwd
														 FROM personne p JOIN etudiant e ON p.per_num=e.per_num WHERE e.per_num=:id");
		$req->bindValue(':id',$id);
		$req->execute();
		$etudiant=new Etudiant($req->fetch());
		if ($etudiant->getPerNom()==null) {
			$etudiant=null;
		}
		$req->closeCursor();
		return $etudiant;
	}
}
?>
