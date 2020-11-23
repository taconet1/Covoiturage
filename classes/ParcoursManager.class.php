<?php
class ParcoursManager{
	private $db;
	public function __construct($db){
		$this->db = $db;
	}

	public function add($parcours){
		$requete = $this->db->prepare(
						'INSERT INTO parcours (par_km, vil_num1,vil_num2) VALUES (:par_km, :ville1, :ville2);');

  					$requete->bindValue(':par_km',$parcours->getKilometre());
						$requete->bindValue(':ville1',$parcours->getVille1());
						$requete->bindValue(':ville2',$parcours->getVille2());

            $retour=$requete->execute();

						return $retour;
	}

	public function existe($ville1, $ville2){
		$req=$this->db->prepare('SELECT par_num FROM parcours WHERE vil_num1=? and vil_num2=? UNION SELECT par_num FROM parcours WHERE vil_num1=? and vil_num2=?');
		$req->bindValue(1,$ville1,PDO::PARAM_STR);
		$req->bindValue(2,$ville2,PDO::PARAM_STR);
		$req->bindValue(3,$ville2,PDO::PARAM_STR);
		$req->bindValue(4,$ville1,PDO::PARAM_STR);
		$req->execute();
		return $req->rowCount();
	}

	public function nombre(){
		$sql = 'SELECT count(par_num) FROM parcours';
		$requete = $this->db->prepare($sql);
    $requete->execute();
		$total = $requete -> fetchColumn();
		$requete->closeCursor();
		return $total;
	}

	public function getAllParcours(){
		$listeParcours = array();
		$sql = 'SELECT par_num, v1.vil_nom as ville1, v2.vil_nom as ville2, par_km as kilometre FROM parcours p JOIN ville v1 ON p.vil_num1=v1.vil_num JOIN ville v2 ON p.vil_num2= v2.vil_num';
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($parcours = $requete->fetch(PDO::FETCH_OBJ))
	    {  $listeParcours[] = new Parcours($parcours);}
			$requete->closeCursor();
			return $listeParcours;
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
			if ($ville_1_A_Ville_2=1) {
				return '0';
			}else {
				return '1';
			}
		}

		public function getParNum($idVilleDepart, $idVilleArrivee){
			$req=$this->db->prepare('SELECT par_num FROM parcours WHERE vil_num1=:idDepart AND vil_num2=:idArrivee');
			$req->bindValue(':idDepart',$idVilleDepart);
			$req->bindValue(':idArrivee',$idVilleArrivee);
			$req->execute();
			return $req->fetchColumn();
		}
}
