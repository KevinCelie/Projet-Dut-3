<?php
include_once '../../bdd.php';

Class Modele_Navbar extends BDD{

	public function __construct(){

	}

	// public function effectuerProjet($recherche){
	// 	$req = self::$DBH -> prepare("select * from Utilisateur where nom = ? or prenom = ?");
	// 	$req -> execute(array($recherche, $recherche));
	// 	return $req;
	// }

	// public function initConnexion(){
	// 	$this ->connexion();
	// }

	public function getQuete(){
		$req = self::$DBH -> prepare("select * from appartientProjet inner join Projet using(idProjet) where idUtilisateur = ? ");
        $req -> execute(array($_SESSION['login']));
        return $req;
		

	}

}
?>
