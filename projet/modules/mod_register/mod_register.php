<?php
include_once "modules/mod_register/controleur_register.php";

class ModRegister {

	private $controleur;

	public function __construct () {
		$this -> controleur = new Controleur_Register();

		if(isset($_GET['action'])){
			$action = htmlspecialchars($_GET['action']);
		}else{
			$action = "bienvenue";
		}
		// $this -> controleur -> affiche_menu();

		switch($action){

			case "formulaire" :
				$this -> controleur -> register();
				break;
				
			case "infosupp" :
				$this -> controleur -> registerInfoSupp();
				break;

			case "modifPass" : 
				$this -> controleur -> afficheModifPass();
				break;

			case "resultModifPass" : 
				$this -> controleur -> resultModifPass();
				break;

			case "verifMail" :
				$this -> controleur -> verifMail();
				break;

			case "changPass" :
				$this -> controleur -> changPass();
				break;

			default :
				// $this -> controleur -> affiche_bienvenue();
				if(!isset($_SESSION['login'])){
					$this -> controleur -> affiche_formulaire();
				}else if(!isset($_SESSION['inscriptionFini'])){
					$this -> controleur -> afficheInfoSupp();
				}

				break;
		}
	}
	
}
?>