<?php
include_once 'bdd.php';

Class Modele_Recherche extends BDD{

	public function __construct(){

	}

	public function effectuerRecherche(){
		$req = self::$DBH -> prepare("select * from Utilisateur where nom = ? or prenom = ?");
		$req -> execute(array($_SESSION['login'] ));
		return $req;
	}

	public function initConnexion(){
		$this ->connexion();
	}

	public function getTable(){
		return self::$DBH -> query("select * from php.profil;");
	}

	public function ajout($nom) {

		$req = self::$DBH -> prepare ("insert into php.profil values (default, ?)");
		$req -> execute(array($nom));
	}


}
?>