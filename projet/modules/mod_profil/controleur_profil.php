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
   // public function affiche_profil($id){
   //    $req = $this -> modele -> getProfil($id);
   //    $req2 = $this -> modele -> getAmi($id);
   // 	$this -> vue -> afficheProfil($req, $req2);
   // }

   public function affiche_profil(){
      $args = func_get_args();
      if(count($args) == 0){
         $req = $this -> modele -> getProfil($_SESSION['login']);
         $req2 = $this -> modele -> getAmi();
      }
      else {
         $req = $this -> modele -> getProfil($args[0]);
         $req2 = $this -> modele -> getAmi($args[0]);
      }
      $this -> vue -> afficheProfil($req, $req2);
   }

   public function ajout_Ami($id){
      $this -> modele -> ajout_Ami($id);
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