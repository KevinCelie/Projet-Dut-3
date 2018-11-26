<?php

include_once "modules/mod_connexion/controleur_connexion.php";

class ModConnexion {

	private $controleur;

	public function __construct () {
		$this -> controleur = new Controleur_Connexion();

		if(isset($_GET['action'])){
			$action = htmlspecialchars($_GET['action']);
		}else{
			$action = "bienvenue";
		}
		$this -> controleur -> affiche_menu();

		switch($action){
			

			case "connexion" :
				$this -> controleur -> connexion();

				break;
			case "deconnexion" :
				$this -> controleur -> deconnexion();	
				break;

			default :
				if(!isset($_SESSION['login'])){
					$this -> controleur -> affiche_formulaire();
				}else{
					$this -> controleur ->afficheDeconnexion();
				}
			
				break;
		}
	}
	
}






?>