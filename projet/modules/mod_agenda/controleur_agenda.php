<?php 

include_once('modules/mod_agenda/modele_agenda.php');
include_once('modules/mod_agenda/vue_agenda.php'); 

Class Controleur_Agenda{
    private $vue;
    private $modele;

    public function __construct(){
        $this -> vue =new Vue_Agenda();
        $this -> modele = new Modele_Agenda();
    }

    public function action(){
        $action=null;
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }
        if(isset($_GET['projet'])) {
            $projet = $_GET['projet'];

            switch($action){
                case "formulaire_ajout":
                    $this->vue->afficheFormulaire();
                    break;
                case "demande_modif":
                    $reqAgenda = $this->modele->getAgenda($projet);
                    $this->vue->demandeModif($reqAgenda);
                    break;
                case "formulaire_modif":
                    if(isset($_POST['idCalendrier'])){
                        $reqAgenda = $this->modele->getEvent($projet);
                        $this->vue->afficheFormulaireModif($reqAgenda);
                    }
                    break;
                case "formulaire_supp":
                    $reqAgenda = $this->modele->getAgenda($projet);
                    $this->vue->afficheFormulaireSupp($reqAgenda);
                    break;
                case "ajouter":
                    $this->modele->ajouterEvent($projet);
                    break;
                case "modifier":
                    $this->modele->modifierEvent();
                    break;
                case "supprimer":
                    $this->modele->suppEvent($projet);
                    break;
                case "refreshAgenda":
                    $reqAgenda = $this->modele->getAgenda($projet);
                    $this->vue->afficheEvent($reqAgenda);
                    break;
                case "ajoutBoutonAjout":
                    $this->vue->ajoutBoutonAjoutEvent();
                    break;
                default:
                    $reqAgenda = $this->modele->getAgenda($projet);
                    $this->vue->afficheAgenda($reqAgenda);
                    break;


            }
        }
    }
}




?>

