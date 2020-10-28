<?php
class Departement{
  private $dep_num;
  private $dep_nom;
  private $vil_num;

  public function __construct($donnees=array()){
    if (!empty($donnees)) {
      $this->affecte($donnees);
    }
  }

  public function affecte($donnees){
    foreach ($donnees as $key => $value) {
      switch ($key) {
        case 'dep_num': $this->setDepNum($value);break;
        case 'dep_nom': $this->setDepNom($value);break;
        case 'vil_num': $this->setVilNum($value);break;
      }
    }
  }

  public function getDepNum(){return $this->dep_num;}
  public function getDepNom(){return $this->dep_nom;}
  public function getVilNum(){return $this->vil_num;}

  public function setDepNum($num){$this->dep_num=$num;}
  public function setDepNom($nom){$this->dep_nom=$nom;}
  public function setVilNum($num){$this->vil_num=$num;}
}
?>
