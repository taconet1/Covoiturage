<?php
class Division{
	private div_num;
	private div_nom;

	public function __construct($donnees){
		if (!empty($donnees)) {
			$this->affecte($donnees);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch ($key) {
				case 'div_num': $this->setDivNum($value);break;
				case 'div_nom': $this->setDivNom($value);break;
			}
		}
	}

	public function getDivNum(){return $this->div_num;}
	public function getDivNom(){return $this->div_nom;}

	public function setDivNum($num){$this->div_num=$num;}
	public function setDivNom($nom){$this->div_nom=$nom;}
}
?>
