<?php
Class Vue_Connexion{
   public function __construct () {
  
   }

   public function menu(){
   	// echo "<a href='index.php?module=joueur&action=bienvenue'>Bienvenue</a><br>";
    //   echo "<a href='index.php'>Retour Choix Modules</a><br/><br/>";
   }

   public function formulaire() {
      echo  "<form method='post' action='index.php?module=connexion&action=connexion' id='connect'>
               <div id='formconnect'>
                 <label class='FormConnectChamp' id='id'>Adresse Mail</label> <input type='text' name='id' class='champconnect'/> <br/>
                 <label class='FormConnectChamp' id='id'>Mot de passe</label> <input type='password' name='mdp' class='champconnect' /> <br/>
                 <input type='submit' value='Valider' class='btn btn_outline_primary'/><br/>
                 <a href='index.php?module=register&action=modifPass'>Réinitialiser votre mot de passe.</a>
               </div>
            </form>";
   }

   public function deconnexion(){
      echo  "<form method='post' action='index.php?module=connexion&action=deconnexion'>
             <input type='submit' value='deconnexion'/>
            </form>";
   }
}
?>