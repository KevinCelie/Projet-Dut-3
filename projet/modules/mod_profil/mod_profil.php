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

		switch($action){
			default :
				$this -> c -> affiche_profil();
				break;

		}
	}
}
?>