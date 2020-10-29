<?php
class Fonction{
  private $fon_num;
  private $fon_libelle;

  public function __construct($donnees=array()){
    if (!empty($donnees)) {
      $this->affecte($donnees);
    }
  }

  public function affecte($donnees){
    foreach ($donnees as $key => $value) {
      switch ($key) {
        case 'fon_num': $this->setFonNum($value);break;
        case 'fon_libelle': $this->setFonLibelle($value);break;
      }
    }
  }

  public function getFonNum(){return $this->fon_num;}
  public function getFonLibelle(){return $this->fon_libelle;}

  public function setFonNum($num){$this->fon_num=$num;}
  public function setFonLibelle($libelle){$this->fon_libelle=$libelle;}
}
?>
