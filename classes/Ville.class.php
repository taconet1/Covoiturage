<?php
class Ville{
	private $vil_num;
	private $vil_nom;

	public function __construct($donnees = array()){
		if (!empty($donnees)) {
			$this->affecte($donnees);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch ($key) {
				case 'vil_num': $this->setVilNum($value);break;
				case 'vil_nom': $this->setVilNom($value);break;
			}
		}
	}

	public function getVilNum(){return $this->vil_num;}
	public function setVilNum($vil_num){$this->vil_num = $vil_num;}
	
	public function getVilNom(){return $this->vil_nom;}
	public function setVilNom($vil_nom){$this->vil_nom = $vil_nom;}
}
?>
