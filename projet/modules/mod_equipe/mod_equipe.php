<?php

include 'modules/mod_equipe/controleur_equipe.php';

Class ModEquipe{

	public function __construct(){

		$this -> c = new Controleur_Equipe;
		$this -> affiche_menu();

		if(isset($_GET['action'])){
			$action = htmlspecialchars($_GET['action']);
		}else{
			$action = "bienvenue";
		}

		switch($action){
			case "bienvenue" :
			$this->c->affiche_bienvenue();
			break;

		case "liste" :
			$this->c->liste();
			break;
		}
	}

	public function affiche_menu()
	{
		$this->c->affiche_menu();
	}

}

?>
