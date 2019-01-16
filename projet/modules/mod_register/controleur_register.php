<?php

include_once 'modules/mod_register/modele_register.php';
include_once 'modules/mod_register/vue_register.php';

Class Controleur_Register{
	private $vue;
	private $modele;

	public function __construct(){
		$this -> vue = new Vue_Register();
		$this -> modele = new Modele_Register();
	}

	public function register() {
	    $this -> modele -> registerBD();
	   header('Location: index.php?module=register');
    }
    public function registerInfoSupp() {
      $this -> modele -> registerInfoSuppBD();
      header('Location: index.php');
    }

    public function affiche_menu(){
   		$this-> vue ->menu();
    }

    public function affiche_bienvenue(){
   		$this -> vue -> bienvenue();
    }

    public function affiche_formulaire() {
    	$this -> vue -> formulaire();
    }
    public function afficheInfoSupp() {
      $musique = $this -> modele -> getMusique();
      $langage = $this -> modele -> getLangage();
      $this -> vue -> infosupp($musique, $langage);
    }

    public function initRegister(){
   		$this -> modele -> initConnexion();
    }

    public function afficheDeconnexion(){
	    $this -> vue -> deconnexion();
	    //header('Location: index.php?module=connexion');
   }

   public function afficheModifPass(){
      $this -> vue -> affichModifPass();
   }

   public function resultModifPass(){
      $result = $this -> modele -> modifPass();
      $this -> vue -> afficheResultModifPass($result);
   }

   public function verifMail(){
      $verif = $this -> modele -> verifMail($_GET['token']);
      $this -> vue -> vueChangPass($verif);
   }
}
?>