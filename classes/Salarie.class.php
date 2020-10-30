<?php
class Salarie extends Personne{
	private $sal_telprof;
	private $fon_num;

	public function __construct($donnees=array()){
		if (!empty($donnees)) {
			parent::affecte($donnees);
			$this->affecte($donnees);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch ($key) {
				case 'sal_telprof': $this->setTelProf($value);break;
				case 'fon_num': $this->setFonNum($value);break;
			}
		}
	}

	public function getTelProf(){return $this->sal_telprof;}
	public function getFonNum(){return $this->fon_num;}

	public function setTelProf($num){$this->sal_telprof=$num;}
	public function setFonNum($num){$this->fon_num=$num;}
}
?>
