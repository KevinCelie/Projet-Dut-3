<?php

include 'modules/mod_joueur/controleur_joueur.php';

Class ModJoueurs{

	private $c;

	public function __construct(){

		$this -> c = new Controleur_Joueur();
		$this-> c -> affiche_menu();

		if(isset($_GET['action'])){
			$action = htmlspecialchars($_GET['action']);
		}else{
			$action = "bienvenue";
		}

		switch($action){
			case "bienvenue" :
				$this -> c -> affiche_bienvenue();
				break;

			case "liste" :
				$this -> c -> affichQuery();
				break;
			case "formulaire" :
				$this -> c -> formulaire();
				break;
			case "ajout" :
				$this -> c -> ajout();

				break;
		}
	}
}
?>