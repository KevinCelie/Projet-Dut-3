<?php
include_once 'bdd.php';

Class Modele_Connexion extends BDD{

	public function __construct(){
	}

	public function initConnexion(){
		$this ->connexion();
	}

	public function connexionBD() {
		if (isset($_POST['id']) && isset($_POST['mdp'])  ) {

			$req = self::$DBH -> prepare ("select idUtilisateur from Identification where adresseMail=? and motDePasse=?");

			$user = $_POST['id'];
			$password = $_POST['mdp'];
			$passwordCrypt = crypt($password, "admin");

			$req -> execute(array($user,$passwordCrypt));
			$test = $req -> fetch();
			if ($test == true) {

				$_SESSION['login'] = $test['idUtilisateur'];

				$req1 = self::$DBH -> prepare ("select idUtilisateur from Utilisateur natural join Identification where adresseMail=?");
				$req1 -> execute(array($user));
				$test1 = $req1 -> fetch();

				if ($test1 == true) {
					// echo "<script type='text/javascript'>alert('". $test1 . "')</script>";
					$_SESSION['inscriptionFini'] = true;
					
				}
			}
		}
	}

	public function deconnexionBD(){
		unset($_SESSION['login']);
		unset($_SESSION['inscriptionFini']);
	}

}
?>