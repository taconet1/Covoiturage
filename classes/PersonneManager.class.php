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
		return $req->execute();;
	}

	public function getNombrePersonne(){
		$req=$this->db->prepare('SELECT COUNT(per_num) FROM personne');
		$req->execute();
		$res=$req->fetchColumn();
		$req->closeCursor();
		return $res;
	}

	public function getAllPersonne(){
		$listePersonnes = array();
		$req=$this->db->prepare('SELECT per_num,per_nom,per_prenom,per_tel,per_mail,per_login FROM personne');
		$req->execute();
		while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
			$listePersonnes[]=new Personne($personne);
		}
		$req->closeCursor();
		return $listePersonnes;
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

	public function getSalarie($id){
		$req=$this->db->prepare('SELECT p.per_num, per_nom, per_prenom, per_mail, per_tel, sal_telprof, fon_num
														 FROM personne p JOIN salarie s ON p.per_num=s.per_num WHERE s.per_num=:id');
		$req->bindValue(':id',$id);
		$req->execute();
		$salarie=new Salarie($req->fetch());
		$req->closeCursor();
		return $salarie;
	}

	public function getPrenomNom($id){
		$req=$this->db->prepare('SELECT per_prenom, per_nom FROM personne WHERE per_num=:per_num');
		$req->bindValue(':per_num', $id);
		$req->execute();

		$personne=$req->fetch();
		$req->closeCursor();
		return $personne;
	}

	public function getMdp($login){
		$req=$this->db->prepare('SELECT per_pwd FROM personne WHERE per_login=:login');
		$req->bindValue(':login',$login);
		$req->execute();

		$res=$req->fetchColumn();
		$req->closeCursor();
		return $res;
	}

	public function getPerNum($login) {
		$req=$this->db->prepare('SELECT per_num FROM personne WHERE per_login=:per_login');
		$req->bindValue(':per_login',$login);
		$req->execute();

		return $req->fetchColumn();
	}

	public function getLogin($per_login){
		$req=$this->db->prepare('SELECT per_nom FROM personne WHERE per_login=:per_login');
		$req->bindValue(':per_login', $per_login);
		$req->execute();

		$personne=$req->fetch();
		$req->closeCursor();
		return $personne;
	}
	public function getDetailPersonneById($id){
		$req=$this->db->prepare('SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd FROM personne WHERE per_num=:id');
		$req->bindValue(':id', $id);
		$req->execute();

		$personne=new Personne($req->fetch(PDO::FETCH_OBJ));
		$req->closeCursor();
		return $personne;
	}

	public function getMdpById($id){
		$req=$this->db->prepare('SELECT per_pwd FROM personne WHERE per_num=:id');
		$req->bindValue(':id',$id);
		$req->execute();

		$res=$req->fetchColumn();
		$req->closeCursor();
		return $res;
	}

	public function modifierDetails($personne) {
		$req=$this->db->prepare('UPDATE personne SET per_nom=:per_nom, per_prenom=:per_prenom, per_tel=:per_tel, per_mail=:per_mail, per_login=:per_login, per_pwd=:per_pwd WHERE per_num=:per_num');

		$req->bindValue(':per_nom',$personne->getPerNom());
		$req->bindValue(':per_prenom',$personne->getPerPrenom());
		$req->bindValue(':per_tel',$personne->getPerTel());
		$req->bindValue(':per_mail',$personne->getPerMail());
		$req->bindValue(':per_login',$personne->getPerLogin());
		if ($personne->getPerPwd()!="") {
			$req->bindValue(':per_pwd',$personne->getPerPwd());
		}else {
			$mdp=$this->getMdpById($personne->getPerNum());
			$req->bindValue(':per_pwd',$mdp);
		}
		$req->bindValue(':per_num',$personne->getPerNum());

		return $req->execute();
}

	public function supprimerPersonne($personne){
		$req=$this->db->prepare('DELETE FROM personne WHERE per_num = '.$personne);
    $req->execute();
	}
	public function supprimerAvis($personne){
    $req=$this->db->prepare('DELETE FROM avis WHERE per_num ='.$personne);
		$req2=$this->db->prepare('DELETE FROM avis WHERE per_per_num ='.$personne);
    $req->execute();
		$req2->execute();
  }

	public function supprimerPropose($personne){
		$req=$this->db->prepare('DELETE FROM propose WHERE per_num = '.$personne);
		$req->execute();
	}

	public function supprimerSalarie($salarie){
    $req=$this->db->prepare('DELETE FROM salarie WHERE per_num = '.$salarie);
    $req->execute();
  }

	public function supprimerEtudiant($etudiant){
		$req=$this->db->prepare('DELETE FROM etudiant WHERE per_num = '.$etudiant);
		$req->execute();
	}
}
