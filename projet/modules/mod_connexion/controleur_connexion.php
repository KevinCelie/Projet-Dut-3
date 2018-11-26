<?php

include_once 'modules/mod_connexion/modele_connexion.php';
include_once 'modules/mod_connexion/vue_connexion.php';

Class Controleur_Connexion{
	private $vue;
	private $modele;

	public function __construct(){
		$this -> vue = new Vue_Connexion();
		$this -> modele = new Modele_Connexion();
	}

   public function affiche_menu(){
   	$this-> vue ->menu();
   }
   
   public function affiche_formulaire() {
      $this -> vue -> formulaire();
   }

   public function connexion() {
      $this -> modele -> connexionBD();
      header('Location: index.php');
   }
   public function deconnexion() {
      $this -> modele -> deconnexionBD();
      header('Location: index.php');
   }

   public function initConnexion(){
   	$this -> modele -> initConnexion();
   }

   public function afficheDeconnexion(){
      $this -> vue -> deconnexion();
      //header('Location: index.php?module=connexion');
   }

}
?>