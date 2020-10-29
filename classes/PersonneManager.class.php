<?php
class PersonneManager{
	private $db;

	public function __construct($db){
		$this->db=$db;
	}

	public function ajouter($personne){
		$req=$this->db->prepare('INSERT INTO personne(per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd)
															VALUES(:per_nom, :per_prenom, :per_tel, :per_mail, :per_login, :per_pwd)');
		$req->bindValue(':per_nom',$personne->getPerNom());
		$req->bindValue(':per_prenom',$personne->getPerPrenom());
		$req->bindValue(':per_tel',$personne->getPerTel());
		$req->bindValue(':per_mail',$personne->getPerMail());
		$req->bindValue(':per_login',$personne->getPerLogin());
		$req->bindValue(':per_pwd',$personne->getPerPwd());
		return $req->execute();
	}

	public function getNombrePersonne(){
		$req=$this->db->prepare('SELECT COUNT(per_num) FROM personne');
		$req->execute();
		return $req->fetchColumn();
	}

	public function getAllPersonne(){
		$listePersonnes = array();
		$req=$this->db->prepare('SELECT per_num,per_nom,per_prenom FROM personne');
		$req->execute();
		while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
			$listePersonnes[]=new Personne($personne);
		}
		return $listePersonnes;
	}

	public function getEtudiant($id){
		$req=$this->db->prepare("SELECT per_nom,per_prenom,per_mail,per_tel,dep_num
														 FROM personne p JOIN etudiant e ON p.per_num=e.per_num WHERE p.per_num=$id");
		$req->execute();
		return new Etudiant($req->fetch(PDO::FETCH_OBJ));
	}
}
