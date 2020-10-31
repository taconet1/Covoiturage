<?php
class FonctionManager{
  private $db;

  public function __construct($db){
    $this->db=$db;
  }

  public function getAllFonction(){
    $liste=array();
    $req=$this->db->prepare('SELECT fon_num, fon_libelle FROM fonction');
    $req->execute();
    while ($fonction = $req->fetch(PDO::FETCH_OBJ)) {
      $liste[]=new Fonction($fonction);
    }
    $req->closeCursor();
    return $liste;
  }
}
?>
