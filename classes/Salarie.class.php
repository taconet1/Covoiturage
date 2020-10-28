<?php
class Salarie{
	private $per_num;
	private $sal_telprof;
	private $fon_num;

	public function __construct($donnees=array()){
		if (!empty($donnees)) {
			$this->affecte($donnees);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch ($key) {
				case 'per_num': $this->setPerNum();break;
				case 'sal_telprof': $this->setTelProf();break;
				case 'fon_num': $this->setFonNum();break;
			}
		}
	}

	public function getPerNum(){return $this->per_num;}
	public function getTelProf(){return $this->sal_telprof;}
	public function getFonNum(){return $this->fon_num;}

	public function setPerNum($num){$this->per_num=$num;}
	public function setTelProf($num){$this->sal_telprof=$num;}
	public function setFonNum($num){$this->fon_num=$num;}
}
?>
