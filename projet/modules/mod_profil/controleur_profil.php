<?php

include_once 'modules/mod_profil/modele_profil.php';
include_once  'modules/mod_profil/vue_profil.php';

Class Controleur_Profil{
	private $vue;
	private $modele;

	public function __construct(){
		$this -> vue = new Vue_Profil();
		$this -> modele = new Modele_Profil();
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
   public function affiche_profil($nom){
      $req = $this -> modele -> getProfil($nom);
   	$this -> vue -> afficheProfil($req);
   }

   //fonction Ajout de profil
   public function formulaire(){
      $this -> vue -> formulaire();
   }
   public function ajout() {

      if(isset($_POST['truc']) && trim($_POST['truc']) != ''){
         $nomprofil = trim(htmlspecialchars($_POST['truc']));
         $this -> modele -> ajout($nomprofil);

      }
      header('Location: index.php?module=profil&action=liste');
   }

}
?>