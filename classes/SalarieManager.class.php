<?php
class SalarieManager{
  private $db;

  public function __construct($db){
    $this->db=$db;
  }

  public function ajouter($salarie){
    $req=$this->db->prepare('INSERT INTO salarie (per_num, sal_telprof, fon_num) VALUES(:per,:sal_telprof,:fon_num)');
    $req->bindValue(':per',$salarie->getPerNum());
    $req->bindValue(':sal_telprof',$salarie->getTelProf());
    $req->bindValue(':fon_num',$salarie->getFonNum());
    return $req->execute();
  }
}
?>
