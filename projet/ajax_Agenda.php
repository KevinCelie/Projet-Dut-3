<?php 
    include_once('modules/mod_agenda/controleur_agenda.php');
    BDD::connexion();
    $controleur = new Controleur_Agenda();
    $controleur -> action();
?>