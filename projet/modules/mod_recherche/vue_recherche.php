<?php
Class Vue_Recherche{
   public function __construct () {
   }

   public function afficheRecherche(){
      echo 
      "
      <form method='post' action='index.php?module=recherche&recherche=true' id='recherche'>
         <div class='form-group'>
            <label for='champRecherche' class='fondGold' > Rechercher </label> 
            <input type='text' name='champRecherche' id='champRecherche' class='form-control'/> 
         </div>
      </form>
      ";
   }

   public function affichePageRecherche($req) {
      while(($line = $req->fetch()) !== false)
      {
         echo 
         "  
            <div class='row'>
               <a href='index.php?module=profil&id=".$line['idUtilisateur']."'>" . $line['nom'] . " " . $line['prenom'] . "</a>

            </div>
         ";
      }
   }
   
}
?>