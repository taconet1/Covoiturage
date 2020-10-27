<?php
class Parcours{
	private $ville1;
	private $ville2;
	private $kilometre;
	public function __construct($valeurs = array()){
		if (!empty($valeurs))
				//print_r ($valeurs);
				 $this->affecte($valeurs);
	}
	public function affecte($donnees){
				foreach ($donnees as $attribut => $valeur){
						switch ($attribut){
								case 'ville1': $this->setville1($valeur); break;
								case 'ville2': $this->setville2($valeur); break;
								case 'kilometre': $this->setKilometre($valeur); break;
						}
				}
		}



	public function getVille1(){
		return $this->ville1;
	}
	public function setVille1 ($ville1) {
	       $this->ville1= $ville1;
  }
	public function getVille2(){
		return $this->ville2;
	}
	public function setVille2 ($ville2) {
		$this->ville2= $ville2;
  }
	public function getKilometre(){
		return $this->kilometre;
	}
	public function setKilometre ($kilometre) {
		$this->kilometre= $kilometre;
  }



}
