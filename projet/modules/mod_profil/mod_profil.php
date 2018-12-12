<?php

include 'modules/mod_profil/controleur_profil.php';

Class ModProfil{

	private $c;

	public function __construct(){

		$this -> c = new Controleur_Profil();

		if(isset($_GET['action'])){
			$action = htmlspecialchars($_GET['action']);
		}else {
			$action = 'menu';
		}
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}
		else{
			$id = null;
		}

		switch($action){
			case "ami" :
				$this -> c -> ajout_Ami($_GET['id']);
				break;
			default :
				$this -> c -> affiche_profil($id);
				break;

		}
	}
}
?>