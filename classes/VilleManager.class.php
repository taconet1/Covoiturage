<?php
class VilleManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function ajouter($vil_nom){
		$req=$this->db->prepare('INSERT INTO ville(vil_nom) VALUES(:vil_nom);');
		$req->bindValue(':vil_nom',$vil_nom);
		return $req->execute();
	}

	public function existe($vil_nom){
		$req=$this->db->prepare('SELECT vil_nom FROM ville WHERE vil_nom=?');
		$req->bindValue(1,$vil_nom,PDO::PARAM_STR);
		$req->execute();
		$resultat=$req->fetch();
		$req->closeCursor();
		return $resultat;
	}

	public function getNombreVille(){
		$req=$this->db->query('SELECT COUNT(vil_num) AS nombreVille FROM ville');
		$resultat=$req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
		return $resultat['nombreVille'];
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

	public function getVille($id){
		$req=$this->db->prepare('SELECT vil_nom FROM ville WHERE vil_num=?');
		$req->bindValue(1,$id,PDO::PARAM_INT);
		$req->execute();
		$res=$req->fetchColumn();
		$req->closeCursor();
		return $res;
	}
}
?>
