<?php
Class Vue_Recherche{
   public function __construct () {
   }

   public function afficheRecherche(){
      echo 
      "
      <form class='form-inline my-2 my-lg-0' action='index.php?module=recherche&recherche=true' method='post'>
         <input class='form-control mr-sm-2' type='text' placeholder='Search' aria-label='Search' name='champRecherche'>
         <button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Search</button>
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