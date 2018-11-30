<?php

include_once 'modules/mod_recherche/modele_recherche.php';
include_once  'modules/mod_recherche/vue_recherche.php';

Class Controleur_Recherche{
	private $vue;
	private $modele;

	public function __construct(){
		$this -> vue = new Vue_Recherche();
		$this -> modele = new Modele_Recherche();
	}

   public function affiche_recherche(){
      $this -> vue -> afficheRecherche();
   }

   public function affiche_page_recherche() {
      if (isset($_POST['champRecherche'])) {
         $req = $this -> modele -> effectuerRecherche($_POST['champRecherche']);
         $this -> vue -> affichePageRecherche($req);
      }
         
   }

   // public function affiche_profil(){
   //    $req = $this -> modele -> getProfil();
   // 	$this -> vue -> afficheProfil($req);
   // }

   // //fonction Ajout de profil
   // public function formulaire(){
   //    $this -> vue -> formulaire();
   // }
   // public function ajout() {

   //    if(isset($_POST['truc']) && trim($_POST['truc']) != ''){
   //       $nomprofil = trim(htmlspecialchars($_POST['truc']));
   //       $this -> modele -> ajout($nomprofil);

   //    }
   //    header('Location: index.php?module=profil&action=liste');
   // }

}
?>