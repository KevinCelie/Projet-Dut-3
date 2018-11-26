<?php

include_once 'modules/mod_equipe/modele_equipe.php';
include_once 'modules/mod_equipe/vue_equipe.php';

Class Controleur_Equipe{
	public $vue;
	public $modele;

	public function __construct(){
		$this -> vue = new Vue_equipe();
		$this -> modele = new Modele_equipe();
	}

	public function liste(){
		$tab = $this -> modele -> getList();
		$this -> vue -> affiche_liste($tab);
	}

	public function affiche_liste ($array){
   	foreach($array as $key => $val){
   		echo $val['nom'];
   	}
   }

   public function affiche_menu(){
   	$this -> vue -> menu();
   }

   public function affiche_bienvenue(){
   	$this -> vue -> bienvenue();
   }

   public function initConnexion(){
   	$this -> modele ->initConnexion();
   }

   public function affichQuery(){
   	$query = $this -> modele ->getTable();
   	$this-> vue ->affichQuery($query);
   }
}
?>