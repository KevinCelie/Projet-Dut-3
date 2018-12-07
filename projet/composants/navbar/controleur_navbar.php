<?php

include_once 'composants/navbar/modele_navbar.php';
include_once  'composants/navbar/vue_navbar.php';

Class Controleur_Navbar{
    private $vue;
    private $modele;

    public function __construct(){
        $this -> vue = new Vue_Navbar();
        $this -> modele = new Modele_Navbar();
    }

    public function affiche_navbar(){
        if(isset($_SESSION['inscriptionFini'])){
            $req = $this -> modele -> getQuete();
            $this -> vue -> affiche_navbar($req);
        }else
            $this -> vue -> affiche_navbar();
    }

    public function affiche_page_projet() {
        $this -> modele -> getProjet();
        $this -> vue -> affiche_projet();

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