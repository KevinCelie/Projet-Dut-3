<?php

include_once 'modules/mod_joueur/modele_joueur.php';
include_once  'modules/mod_joueur/vue_joueur.php';

Class Controleur_Joueur{
	private $vue;
	private $modele;

	public function __construct(){
		$this -> vue = new Vue_joueur();
		$this -> modele = new Modele_joueur();
	}
   /*
	public function liste(){
		$tab = $this->modele->getList();
		$this->vue->affiche_liste($tab);
	}

	public function affiche_liste ($array){
   	foreach($array as $key => $val){
   		echo $val['nom'];
   	}
   }
   */
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
   	$result = $this -> modele -> getTable();
   	$this -> vue -> affichQuery($result);
   }

   //fonction Ajout de Joueur
   public function formulaire(){
      $this -> vue -> formulaire();
   }
   public function ajout() {

      if(isset($_POST['truc']) && trim($_POST['truc']) != ''){
         $nomJoueur = trim(htmlspecialchars($_POST['truc']));
         $this -> modele -> ajout($nomJoueur);

      }
      header('Location: index.php?module=joueur&action=liste');
   }

}
?>