<?php
include_once('../../bdd.php');

Class Modele_Agenda extends BDD{

    public function __construct(){
    }

    public function getAgenda($projet){
        $req = BDD::$DBH -> prepare("select * from aEvent natural join Evenement where idProjet = ?");
        $req -> execute(array($projet));
        return $req;
    }
    
    public function getEvent($projet) {
        $req = BDD::$DBH -> prepare("select * from aEvent natural join Evenement where idProjet = ? and idCalendrier=?");
        $req -> execute(array($projet, $_POST['idCalendrier']));
        return $req;
    }

    public function ajouterEvent($projet){
        $req = BDD::$DBH -> prepare("insert into Evenement values(default,?,?,?,?,?)");
        $req -> execute(array($_POST['champDateDebut'],$_POST['champHeureDebut'],$_POST['champDateFin'],$_POST['champHeureFin'],htmlspecialchars($_POST['champDesc'])));
        $req2 = BDD::$DBH -> prepare("select * from Evenement where dateDebut=? and dateFin=? and description=?");
        $req2 -> execute(array($_POST['champDateDebut'],$_POST['champDateFin'],htmlspecialchars($_POST['champDesc'])));
        $line = $req2 -> fetch();
        $req3 = BDD::$DBH -> prepare("insert into aEvent values(?,?)");
        $req3 -> execute(array($projet, $line['idCalendrier']));
    }
    public function modifierEvent(){
        $req = BDD::$DBH -> prepare("update Evenement set dateDebut=?, dateFin=?, heureDebut=?, heureFin=?, description=? where idCalendrier=?");
        $req -> execute(array($_POST['champDateDebut'],$_POST['champDateFin'],$_POST['champHeureDebut'],$_POST['champHeureFin'],htmlspecialchars($_POST['champDesc']),$_POST['champCalendrier']));
    }

    public function suppEvent($projet){
        $idEvent = $_POST['idEvent'];
        echo idEvent;
        echo $_SESSION['login'];
        $verifAuth = BDD::$DBH -> prepare("select * from appartientProjet natural join Projet inner join aEvent using(idProjet) where idUtilisateur=? and aEvent.idCalendrier=? and estRequete=0 ");
        $verifAuth-> execute(array($_SESSION['login'], $idEvent));
        /*if($verifAuth -> fetch() != false) {*/
            $req = BDD::$DBH ->prepare("delete from aEvent where idCalendrier=?");
            $req -> execute(array($idEvent));
            $req2 = BDD::$DBH -> prepare("delete from Evenement where idCalendrier=?");
            $req2 -> execute(array($idEvent));
        /*}*/
    }


}

?>