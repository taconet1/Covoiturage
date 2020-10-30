<?php
class SalarieManager{
  private $db;

  public function __construct($db){
    $this->db=$db;
  }

  public function ajouter($salarie){
    $req=$this->db->prepare('INSERT INTO salarie(per_num, sal_telprof, fon_num) VALUES(:per_num,:sal_telprof,:fon_num)');
    $req->bindValue(':per_num',$salarie->getPerNum());
    $req->bindValue(':sal_telprof',$salarie->getTelProf());
    $req->bindValue(':fon_num',$salarie->getFonNum());
    return $req->execute();
  }

  public function getSalFon($id){
    $req=$this->db->prepare("SELECT fon_nom FROM salarie s JOIN fonction f ON s.fon_num=f.fon_num WHERE per_num=$id");
    $req->execute();
    return $req->fetchColumn();
  }
}
?>
