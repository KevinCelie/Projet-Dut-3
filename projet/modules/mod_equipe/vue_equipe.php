<?php
Class Vue_equipe{
   public function __construct () {
   }

   public function affiche_liste ($array){
   	foreach($array as $key => $val){
   		echo $val['nom'] ."<br/>";
   	}
   }

   public function menu(){
   	// echo "<a href='index.php?module=equipe&action=bienvenue'>Bienvenue</a><br>";
   	echo "<a href='index.php?module=equipe&action=liste' id='liste'>Liste</a><br/>";
      // echo "<a href='index.php'>Retour Choix Modules</a><br/><br/>";
   }

   public function bienvenue(){
   	echo "Bienvenue dans le modèle Équipe.<br/>";
   }

   public function affichQuery($query){
   	while(($line = $query->fetch()) !== false){
		 echo $line['idcom'] . $line['username'] . "<br/>";
	
    }
	}
}
?>