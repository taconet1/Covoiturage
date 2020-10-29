<?php
class Etudiant extends Personne{
	private $dep_num;
	private $div_num;

	public function __construct($donnees=array()){
		if (!empty($donnees)) {
			parent::affecte($donnees);
			$this->affecte($donnees);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch ($key) {
				case 'dep_num': $this->setDepNum($value);break;
				case 'div_num': $this->setDivNum($value);break;
			}
		}
	}

	public function getDepNum(){return $this->dep_num;}
	public function getDivNum(){return $this->div_num;}

	public function setDepNum($num){$this->dep_num=$num;}
	public function setDivNum($num){$this->div_num=$num;}
}
?>
