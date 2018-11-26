<?php
Class Vue_Profil{
   public function __construct () {
   }

   public function affiche_liste ($array){
   	foreach($array as $key => $val){
   		echo $val['nom'] . "<br/>";
   	}
      echo "<a href='index.php?module=profil&action=formulaire'>Ajouter profil</a><br/>";
   }

   public function afficheProfil($req){
      $line = $req->fetch();
      
      
   }

   
}
?>

<div class ="row">

</div>