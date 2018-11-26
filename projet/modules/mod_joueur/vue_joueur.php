<?php
Class Vue_joueur{
   public function __construct () {
   }

   public function affiche_liste ($array){
   	foreach($array as $key => $val){
   		echo $val['nom'] . "<br/>";
   	}
      echo "<a href='index.php?module=joueur&action=formulaire'>Ajouter joueur</a><br/>";
   }

   public function menu(){
   	// echo "<a href='index.php?module=joueur&action=bienvenue'>Bienvenue</a><br>";
   	echo "<a href='index.php?module=joueur&action=liste' id='liste'>Liste</a><br/>";
      // echo "<a href='index.php'>Retour Choix Modules</a><br/><br/>";
   }

   public function bienvenue(){
   	echo "Bienvenue dans le module Joueur.<br/>";
   }

   public function affichQuery($query){
   	while(($line = $query->fetch()) !== false){
         echo $line['nom'] . "<br>";
	
      }
      echo "<a href='index.php?module=joueur&action=formulaire' id='addjoueur'>Ajouter joueur</a><br/>";
	}

   public function formulaire() {
      echo  "<form method='post' action='index.php?module=joueur&action=ajout'>
               <p>
                 <label>Nom du joueur</label> : <input type='text' name='truc' />
               </p>
            </form>";
   }

}
?>