<?php
class Personne{
	private $per_num;
	private $per_nom;
	private $per_prenom;
	private $per_tel;
	private $per_mail;
	private $per_login;
	private $per_pwd;

	public function __construct($donnees=array()){
		if (!empty($donnees)) {
				$this->affecte($donnees);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch ($key) {
				case 'per_num': $this->setPerNum($value);break;
				case 'per_nom': $this->setPerNom($value);break;
				case 'per_prenom': $this->setPerPrenom($value);break;
				case 'per_tel': $this->setPerTel($value);break;
				case 'per_mail': $this->setPerMail($value);break;
				case 'per_login': $this->setPerLogin($value);break;
				case 'per_pwd': $this->setPerPwd(sha1(sha1($value).SALT));break;
			}
		}
	}

	public function getPerNum(){return $this->per_num;}
	public function getPerNom(){return $this->per_nom;}
	public function getPerPrenom(){return $this->per_prenom;}
	public function getPerTel(){return $this->per_tel;}
	public function getPerMail(){return $this->per_mail;}
	public function getPerLogin(){return $this->per_login;}
	public function getPerPwd(){return $this->per_pwd;}

	public function setPerNum($num){$this->per_num = $num;}
	public function setPerNom($nom){$this->per_nom = $nom;}
	public function setPerPrenom($prenom){$this->per_prenom = $prenom;}
	public function setPerTel($tel){$this->per_tel = $tel;}
	public function setPerMail($mail){$this->per_mail = $mail;}
	public function setPerLogin($login){$this->per_login = $login;}
	public function setPerPwd($pwd){$this->per_pwd = $pwd;}
}
?>
