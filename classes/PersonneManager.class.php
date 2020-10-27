<?php
class PersonneManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function ajouter($nom, $prenom, $tel, $mail, $login, $pwd){
		$req=$this->db->prepare('INSERT INTO personne(per_nom,per_prenom,per_tel,per_mail,per_login,per_pwd) VALUES(:per_nom,:per_prenom,:per_tel,:per_mail,:per_login,:per_pwd)');
		$req->bindValue(':pre_nom',$nom);
		$req->bindValue(':pre_prenom',$prenom);
		$req->bindValue(':pre_tel',$tel);
		$req->bindValue(':pre_mail',$mail);
		$req->bindValue(':pre_login',$login);
		$req->bindValue(':pre_pwd',$pwd);

		return $req->execute();
	}

	public function getNombrePersonne(){
		$req=$this->db->prepare('SELECT COUNT(per_num) FROM personne');
		$req->execute();
		return 	$req->fetchColumn();
	}

	public function getAllPersonne(){
		$listePersonnes = array();

		$req=$this->db->prepare('SELECT per_num,per_nom,per_prenom FROM personne');
		$req->execute();
		while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
			$listePersonnes[]=new Personne($personne);
		}
		$req->closeCursor();

		return $listePersonnes;
	}

}
