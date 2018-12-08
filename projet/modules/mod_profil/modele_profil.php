<?php
include_once '../../bdd.php';

Class Modele_Profil extends BDD{

	public function __construct(){

	}

	public function getProfil($id){
		if ($id == null) {
			$id = $_SESSION['login'];
		}
		else {
			$reqChercheId = self::$DBH -> prepare("select * from Utilisateur where idUtilisateur = ");
			$reqChercheId -> execute(array($id));
			$line = $reqChercheId -> fetch();
			if ($line == true) {
				$id = $line['idUtilisateur'];
			}
		}
		$req = self::$DBH -> prepare("select * from Utilisateur inner join maitrise using (idUtilisateur) inner join ecoute using(idUtilisateur) where Utilisateur.idUtilisateur = ?");
		$req -> execute(array($id));
		return $req;
	}

	// public function getAmi($id){
	// 	$req = self::$DBH -> prepare("select * from sontAmis where (idUtilisateur = ? and idUtilisateur_sontAmis = ?) or (idUtilisateur = ? and idUtilisateur_sontAmis = ?)");
	// 	$req -> execute(array($id, $_SESSION['login'], $_SESSION['login'], $id));
	// }

	public function getAmi(){
		$args = func_get_args();
		if(count($args) == 0) {
			$req = self::$DBH -> prepare("select * from sontAmis where idUtilisateur = ? or idUtilisateur_sontAmis = ? and sontAmis= 1");
			$req -> execute(array($_SESSION['login'], $_SESSION['login']));
		}
		else {
			$req = self::$DBH -> prepare("select * from sontAmis where (idUtilisateur = ? and idUtilisateur_sontAmis = ?) or (idUtilisateur = ? and idUtilisateur_sontAmis = ?)");
			$req -> execute(array($args[0], $_SESSION['login'], $_SESSION['login'], $args[0]));
		}
		return $req;
	}
    
    public function getMesQuetes(){
        $req = self::$DBH -> prepare("select * from appartientProjet inner join Projet using(idProjet) where idUtilisateur = ?");
        $req -> execute(array($_SESSION['login']));
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

	public function ajout_Ami($id){
		$reqSelect = self::$DBH -> prepare("select * from sontAmis where idUtilisateur = ? and idUtilisateur_sontAmis = ?");
		$reqSelect -> execute(array($id, $_SESSION['login']));
		$line = $reqSelect -> fetch();
			if ($line == true) {
				$reqUpdate = self::$DBH -> prepare("UPDATE sontAmis SET sontAmis = 1 where idUtilisateur = ? and idUtilisateur_sontAmis = ?");
				$reqUpdate -> execute(array($id,$_SESSION['login']));
			}else{
				$reqInsert = self::$DBH -> prepare("INSERT INTO sontAmis VALUES (?,?,0)");
				$reqInsert -> execute(array($_SESSION['login'], $id));
			}
			header("Location:index.php?module=profil&id=".$id);
	}

}
?>
