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
   
}
?>