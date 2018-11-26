<?php
	include "bdd.php";
	BDD::connexion();


	if(isset($_GET['module'])){
		$module = htmlspecialchars($_GET['module']);
	}else{
		$module = "autre";
	}

	switch($module){
		case "modJoueurs" : 
			include "mod_joueurs.php";
			$m = new ModJoueurs();
			break;

		case"modEquipe" :
			include "mod_Equipe.php";
			$m = new ModEquipe();
			break;
	}

	

?>