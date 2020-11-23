<?php
class ProposeManager{
	private $db;

	public function __construct($db){
		$this->db=$db;
	}

	public function ajouter($trajetPropose) {
		$req=$this->db->prepare('INSERT INTO propose(par_num, per_num, pro_date, pro_time, pro_place, pro_sens)
																				 VALUES(:par_num, :per_num, :pro_date, :pro_time, :pro_place, :pro_sens)');
		$req->bindValue(':par_num',$trajetPropose->getParNum());
		$req->bindValue(':per_num',$trajetPropose->getPerNum());
		$req->bindValue(':pro_date',$trajetPropose->getProDate());
		$req->bindValue(':pro_time',$trajetPropose->getProTime());
		$req->bindValue(':pro_place',$trajetPropose->getProPlace());
		$req->bindValue(':pro_sens',$trajetPropose->getProSens());

		return $req->execute();
	}

	public function existe($trajetPropose){
		$req=$this->db->prepare('SELECT par_num, per_num, pro_date, pro_time FROM propose
																		WHERE par_num=:par_num AND per_num=:per_num AND pro_date=:pro_date AND pro_time=:pro_time');
		$req->bindValue(':par_num',$trajetPropose->getParNum());
		$req->bindValue(':per_num',$trajetPropose->getPerNum());
		$req->bindValue(':pro_date',$trajetPropose->getProDate());
		$req->bindValue(':pro_time',$trajetPropose->getProTime());
		$req->execute();

		return $req->rowCount();
	}

	
}
?>
