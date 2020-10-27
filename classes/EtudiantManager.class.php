<?php
class EtudiantManager{
	private $db;

	public function __construct($db){
		$this->db=$db;
	}

	public function ajouter($etudiant){
		$req=$this->db->prepare('INSERT INTO etudiant(per_num,dep_num,div_num) VALUES(:)');
	}
}
