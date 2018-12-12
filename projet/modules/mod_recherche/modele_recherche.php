<?php
include_once '../../bdd.php';

Class Modele_Recherche extends BDD{

	public function __construct(){

	}

	public function effectuerRechercheProfil($recherche){
		$req = self::$DBH -> prepare("select * from Utilisateur where nom like ? or prenom like ?");
		$req -> execute(array('%' . $recherche . '%', '%' . $recherche . '%'));
		return $req;
	}
    public function effectuerRechercheProjet($recherche){
		$req = self::$DBH -> prepare("select * from Projet where projet like ?");
		$req -> execute(array('%' . $recherche . '%'));
		return $req;
	}

	public function initConnexion(){
		$this ->connexion();
	}

	public function getTable(){
		return self::$DBH -> query("select * from php.profil;");
	}
}
?>
