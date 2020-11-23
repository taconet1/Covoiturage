<?php
class Propose{
	private $par_num;
  private $per_num;
  private $pro_date;
  private $pro_time;
  private $pro_place;
  private $pro_sens;

  public function __construct($donnees=array()){
    if (!empty($donnees)) {
      $this->affecte($donnees);
    }
  }

  public function affecte($donnees){
    foreach ($donnees as $key => $value) {
      switch ($key) {
        case 'par_num': $this->setParNum($value); break;
        case 'per_num': $this->setPerNum($value); break;
        case 'dateDepart': $this->setProDate($value); break;
        case 'heureDepart': $this->setProTime($value); break;
        case 'places': $this->setProPlace($value); break;
        case 'pro_sens': $this->setProSens($value); break;
      }
    }
  }

  public function getParNum(){return $this->par_num;}
  public function getPerNum(){return $this->per_num;}
  public function getProDate(){return $this->pro_date;}
  public function getProTime(){return $this->pro_time;}
  public function getProPlace(){return $this->pro_place;}
  public function getProSens(){return $this->pro_sens;}

  public function setParNum($num){$this->par_num=$num;}
  public function setPerNum($num){$this->per_num=$num;}
  public function setProDate($date){$this->pro_date=$date;}
  public function setProTime($time){$this->pro_time=$time;}
  public function setProPlace($place){$this->pro_place=$place;}
  public function setProSens($sens){$this->pro_sens=$sens;}
}
?>
