<?php
include_once '../../bdd.php';

Class Modele_Navbar extends BDD{

	public function __construct(){

	}

	public function getQuete(){
		$req = self::$DBH -> prepare("select * from appartientProjet inner join Projet using(idProjet) where idUtilisateur = ? ");
        $req -> execute(array($_SESSION['login']));
        return $req;
	}
    public function getRequeteQuete(){
        $req = self::$DBH -> prepare("select * from requeteProjet inner join Projet using(idProjet) where idUtilisateur = ? and invitation = 0");
        $req -> execute(array($_SESSION['login']));
        return $req;
    }

}
?>
