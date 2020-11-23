<?php
class VilleManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function ajouter($ville){
		$req=$this->db->prepare('INSERT INTO ville(vil_nom) VALUES(:vil_nom);');
		$req->bindValue(':vil_nom',$ville);
		$res=$req->execute();
		return $res;
	}

	public function existe($ville){
		$req = $this->db->prepare('SELECT vil_nom FROM ville WHERE vil_nom=?');
		$req->bindValue(1,$ville,PDO::PARAM_STR);
		$req->execute();
		return $req->rowCount();
	}

	public function getNombreVille(){
		$req=$this->db->query('SELECT COUNT(vil_num) FROM ville');
		$res=$req->fetchColumn();
		$req->closeCursor();
		return $res;
	}

	public function getAllVille(){
		$listeVilles=array();
		$requete = $this->db->query('SELECT vil_num, vil_nom FROM ville ORDER BY 2');
		while ($ligne = $requete->fetch(PDO::FETCH_OBJ)){
			$listeVilles[] = new Ville($ligne);
		}
		$requete->closeCursor();
		return $listeVilles;
	}

	public function getVil($id){
		$req=$this->db->prepare('SELECT vil_nom FROM ville WHERE vil_num=?');
		$req->bindValue(1,$id,PDO::PARAM_INT);
		$req->execute();
		$res=$req->fetchColumn();
		$req->closeCursor();
		return $res;
	}
}
?>
