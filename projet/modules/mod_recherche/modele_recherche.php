<?php
include_once 'bdd.php';

Class Modele_Recherche extends BDD{

	public function __construct(){

	}

	public function effectuerRecherche($recherche){
		$req = self::$DBH -> prepare("select * from Utilisateur where nom = ? or prenom = ?");
		$req -> execute(array($recherche, $recherche));
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