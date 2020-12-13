<?php

class AvisManager {
  private $db;

  public function __construct($db){
    $this->db=$db;
  }

  public function getMoyenneAvis($par_num, $per_num){
    $req=$this->db->prepare('SELECT AVG(avi_note) FROM avis WHERE per_num=:per_num AND par_num=:par_num');
    $req->bindValue(':per_num', $per_num);
    $req->bindValue(':par_num', $par_num);
    $req->execute();
    $res=$req->fetchColumn();
    $req->closeCursor();
    return $res;
  }

  public function getAvisCommentaire($par_num, $per_num){
    $req=$this->db->prepare('SELECT avi_comm FROM avis WHERE per_num=:per_num AND par_num=:par_num');
    $req->bindValue(':per_num', $per_num);
    $req->bindValue(':par_num', $par_num);
    $req->execute();
    $res=$req->fetchColumn();
    $req->closeCursor();
    return $res;
  }

  public function supprimerAvis($personne){
    $req=$this->db->prepare('DELETE FROM avis WHERE per_num ='.$personne);
    $req2=$this->db->prepare('DELETE FROM avis WHERE per_per_num ='.$personne);
    $req->execute();
    $req2->execute();
  }
}
?>
