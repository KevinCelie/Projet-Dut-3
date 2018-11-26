<?php

include_once 'modules/mod_recherche/controleur_recherche.php';

Class ModRecherche{

	private $c;

	public function __construct(){

		$this -> c = new Controleur_Recherche();
	}

	public function action($action){
		switch($action){
			case "recherche":
				$this -> c -> affiche_recherche();
				break;
			case "pageRecherche":
				$this -> c -> affiche_page_recherche();
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