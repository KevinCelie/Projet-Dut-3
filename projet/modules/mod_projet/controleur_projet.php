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
            if(!isset($_GET['projet']) && action == "affiche") {
                $action = null;
            }
        }
        /*Si aucun projet n'est spécifié alors on retourne sur la page de creation*/

        switch($action){
            case "affiche":
                $req = $this -> modele -> getProjet($_GET['projet']);
                if($req != null) {
                    $this -> vue -> affiche_projet($req);
                }
                else
                    header("Location:index.php?module=projet");
                break;
            case "creation":
                $id = $this -> modele -> creation_quete();
                header("Location:index.php?module=projet&action=affiche&projet=$id")
                break;
            default:
                $this -> affiche_page_creation_projet();
                break;

        }

        // if(isset($_GET['action'])){
        // 	$action = htmlspecialchars($_GET['action']);
        // }else {
        // 	$action = 'menu';
        // }
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