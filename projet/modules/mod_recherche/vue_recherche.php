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

    public function affichePageRecherche($profil, $projet) {
        echo "<h2>Profils :</h2>";

        while(($line = $profil->fetch()) !== false)
        {
            echo 
                "  
            <div>
               <a href='index.php?module=profil&id=".$line['idUtilisateur']."' title='" . $line['description'] ."' > - " . $line['nom'] . " " . $line['prenom'] . "</a>

            </div>
         ";
        }
        echo "<h2>Quêtes :</h2>";

        while(($line = $projet->fetch()) !== false)
        {
          if($line['estPrive'] == 0) {
            echo 
                "  
            <div>
               <a href='index.php?module=projet&action=affiche&projet=".$line['idProjet']."' title='" . $line['projetDescription'] ."'> - " . $line['projet'] . "</a>

            </div>
         ";
          }
        }
    }

}
?>