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

    public function affiche_profil($id){
        if($id == NULL){
            $req = $this -> modele -> getProfil($_SESSION['login']);
            $req2 = $this -> modele -> getAmi();
            $this -> vue -> afficheProfil($req, $req2);
        }
        else {
            $req = $this -> modele -> getProfil($id);
            $req2 = $this -> modele -> getAmi($id);
            $mesQuetes = $this -> modele -> getMesQuetesPourInvitation($id);
            $this -> vue -> afficheProfil($req, $req2, $mesQuetes);
        }
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