<?php

include_once 'modules/mod_projet/modele_projet.php';
include_once  'modules/mod_projet/vue_projet.php';

Class Controleur_Projet{
    private $vue;
    private $modele;

    public function __construct(){
        $this -> vue = new Vue_Projet();
        $this -> modele = new Modele_Projet();
    }

    public function action() {
        $action=null;
        if(isset($_GET['action'])) {
            $action = $_GET['action'];
        }
        /*Si aucun projet n'est spécifié alors on retourne sur la page de creation*/

        switch($action){
            case "affiche":

                if(isset($_GET['projet'])) {
                    $projet = $this -> modele -> getProjet($_GET['projet']);
                    $estMembre = $this->modele->estMembre();
                    if($projet != null) {
                        $membre = $this -> modele -> getMembres($_GET['projet']); 
                        $this -> vue -> affiche_projet($projet, $membre,$estMembre);
                        break;
                    }
                }
                header("Location:index.php?module=projet");
                break;

            case "creation":
                $id = $this -> modele -> creation_quete();
                header("Location:index.php?module=projet&action=affiche&projet=$id");
                break;
            case "formulaireModif":
                $infoProjet = $this -> modele -> getProjet($_GET['projet']);
                $this -> vue -> formulaireModif($infoProjet);
                break;
            case "modification":
                $this->modele->modificationProjet();
                header("Location:index.php?module=projet&action=affiche&projet=".$_POST['champId']);
                break;
            case "invite":
                if(isset($_GET['profil']) && isset($_GET['projet'])){
                    $this -> modele -> invite($_GET['projet'],$_GET['profil']);
                    header("Location:index.php?module=profil&id=".$_GET['profil']);
                }else
                    header("Location:index.php?module=profil");
                break;

            case "accepte":
                if(isset($_GET['profil']) && isset($_GET['projet'])){
                    $this -> modele -> accepte($_GET['projet'],$_GET['profil']);
                    header("Location:index.php?module=projet&action=affiche&projet=".$_GET['projet']);
                }else
                    header("Location:index.php?module=projet");
                break;

            default:
                $this -> affiche_page_creation_projet();
                break;

        }
    }

    private function affiche_projet($id){
        $this -> modele -> getProjet();
        $this -> vue -> afficheProjet();
    }

    private function affiche_page_creation_projet() {
        $this -> vue -> affiche_page_creation_projet();

    }
}
?>