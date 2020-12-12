<?php
class SalarieManager{
  private $db;

  public function __construct($db){
    $this->db=$db;
  }

  public function ajouter($salarie){
    $req=$this->db->prepare('INSERT INTO salarie (per_num, sal_telprof, fon_num) VALUES(:per_num,:sal_telprof,:fon_num)');
    $req->bindValue(':per_num',$salarie->getPerNum());
    $req->bindValue(':sal_telprof',$salarie->getTelProf());
    $req->bindValue(':fon_num',$salarie->getFonNum());
    return $req->execute();
  }

  public function supprimerById($id) {
    $req=$this->db->prepare('DELETE FROM salarie WHERE per_num=:per_num');
    $req->bindValue(':per_num',$id);
    return $req->execute();
  }

  public function modifierDetails($salarie) {
    $req=$this->db->prepare('UPDATE salarie SET sal_telprof=:sal_telprof, fon_num=:fon_num WHERE per_num=:per_num');
    $req->bindValue(':sal_telprof', $salarie->getTelProf());
    $req->bindValue(':fon_num', $salarie->getFonNum());
    $req->bindValue(':per_num', $salarie->getPerNum());
    return $req->execute();
  }
}
?>
