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
				case '':
					// code...
					break;

				default:
					// code...
					break;
			}
		}
	}
}
?>
