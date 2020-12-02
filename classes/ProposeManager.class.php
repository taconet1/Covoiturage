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

	public function getListeVilleDepart(){
		$liste=array();
		$req=$this->db->query('SELECT vil_num, vil_nom FROM parcours p JOIN ville v ON p.vil_num1=v.vil_num
													 UNION SELECT vil_num, vil_nom FROM parcours p JOIN ville v2 ON p.vil_num2=v2.vil_num ORDER BY 2 ');
		while ($ville=$req->fetch(PDO::FETCH_OBJ)) {
			$liste[]=new Ville($ville);
		}
		$req->closeCursor();
		return $liste;
	}

	public function getListeVilleArrivee($idVilleDepart){
		$liste=array();
		$req=$this->db->prepare('SELECT vil_num2 AS vil_num, vil_nom FROM parcours p JOIN ville v ON p.vil_num2=v.vil_num WHERE vil_num1=:id
														 UNION SELECT vil_num1 AS vil_num ,vil_nom FROM parcours p JOIN ville v2 ON p.vil_num1=v2.vil_num WHERE vil_num2=:id');
		$req->bindValue(':id',$idVilleDepart);
		$req->execute();
		while($ville=$req->fetch(PDO::FETCH_OBJ)){
			$liste[]=new Ville($ville);
		}
		$req->closeCursor();
		return $liste;
	}

	public function getSensTrajet($idVilleDepart){
		$req=$this->db->prepare('SELECT vil_num1 FROM parcours WHERE vil_num1=:id');
		$req->bindValue(':id',$idVilleDepart);
		$req->execute();
		$ville_1_A_Ville_2=$req->fetchColumn();
		if ($ville_1_A_Ville_2==$idVilleDepart) {
			return '0';
		}else {
			return '1';
		}
	}

	public function getParNum($idVilleDepart, $idVilleArrivee){
		$req=$this->db->prepare('SELECT par_num FROM parcours WHERE vil_num1=:idDepart AND vil_num2=:idArrivee UNION SELECT par_num FROM parcours WHERE vil_num1=:idArrivee AND vil_num2=:idDepart');
		$req->bindValue(':idDepart',$idVilleDepart);
		$req->bindValue(':idArrivee',$idVilleArrivee);
		$req->execute();
		return $req->fetchColumn();
	}

	public function getListeVilleDepartDeLaRecherche(){
		$liste=array();
		$req=$this->db->query('SELECT vil_num, vil_nom FROM propose pro JOIN parcours p ON pro.par_num=p.par_num JOIN ville v ON p.vil_num1=v.vil_num
													 UNION SELECT vil_num, vil_nom FROM propose pro JOIN parcours p ON pro.par_num=p.par_num JOIN ville v ON p.vil_num2=v.vil_num
													 WHERE pro_sens=0 ORDER BY 2');
		while ($ville=$req->fetch(PDO::FETCH_OBJ)) {
			$liste[]=new Ville($ville);
		}
		$req->closeCursor();
		return $liste;
	}

	public function getAllTrajetsRecherches($infos){
		$liste=array();
		$req=$this->db->prepare('SELECT par_num, per_num, pro_date, pro_time, pro_place FROM propose WHERE par_num=:par_num AND pro_time>=:heureDepart AND pro_sens=:pro_sens AND pro_date BETWEEN :dateDebut AND :dateFin');
		$req->bindValue(':par_num', $infos['par_num']);
		$req->bindValue(':heureDepart', $infos['heureDepart']);
		$req->bindValue(':dateDebut', $infos['dateDebut']);
		$req->bindValue(':dateFin', $infos['dateFin']);
		$req->bindValue(':pro_sens', $infos['pro_sens']);
		$req->execute();

		while ($trajet=$req->fetch(PDO::FETCH_OBJ)) {
			$liste[]=new Propose($trajet);
		}
		$req->closeCursor();
		return $liste;
	}
}
?>
