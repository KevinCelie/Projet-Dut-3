<?php

include_once 'modules/mod_projet/controleur_projet.php';

Class ModProjet{

	private $c;

	public function __construct(){

		$this -> c = new Controleur_Projet();
	}

	public function action($action){
		switch($action){
			// case "projet":
			// 	$this -> c -> affiche_projet();
			// 	break;
			case "pageProjet":
				$this -> c -> affiche_page_projet();
				break;

		}

		// if(isset($_GET['action'])){
		// 	$action = htmlspecialchars($_GET['action']);
		// }else {
		// 	$action = 'menu';
		// }
	}
}
?>