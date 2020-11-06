<?php
class Avis{
  private $per_num;
  private $per_per_num;
  private $par_num;
  private $avi_comm;
  private $avi_note;
  private $avi_date;

  public function __construct($donnees=array()){
    if (!empty($donnees)) {
      $this->affecte($donnees);
    }
  }

  public function affecte($donnees){
    foreach ($donnees as $key => $value) {
      switch ($key) {
        case 'per_num': $this->setPerNum($value); break;
        case 'per_per_num': $this->setPerPerNum($value); break;
        case 'par_num': $this->setParNum($value); break;
        case 'avi_comm': $this->setAviCommentaire($value); break;
        case 'avi_note': $this->setAviNote($value); break;
        case 'avi_date': $this->setAviDate($value); break;
      }
    }
  }

  public function getPerNum(){return $this->per_num;}
  public function getPerPerNum(){return $this->per_per_num;}
  public function getParNum(){return $this->par_num;}
  public function getAviCommentaire(){return $this->avi_comm;}
  public function getAviNote(){return $this->avi_note;}
  public function getAviDate(){return $this->avi_date;}

  public function setPerNum($num){$this->per_num=$num;}
  public function setPerPerNum($num){$this->per_per_num=$num;}
  public function setParNum($num){$this->par_num=$num;}
  public function setAviCommentaire($commentaire){$this->avi_comm=$commentaire;}
  public function setAviNote($note){$this->avi_note=$note;}
  public function setAviDate($date){$this->avi_date=$date;}
}

?>
