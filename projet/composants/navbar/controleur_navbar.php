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
            $req2 = $this -> modele -> getRequeteQuete();
            $this -> vue -> affiche_navbar($req,$req2);
        }else
            $this -> vue -> affiche_navbar();
    }

    public function affiche_page_projet() {
        $this -> modele -> getProjet();
        $this -> vue -> affiche_projet();

    }


}
?>