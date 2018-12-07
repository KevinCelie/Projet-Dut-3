<?php
Class Vue_Navbar{
    public function __construct () {
    }

    public function afficheProjet(){
        echo 
            "
      <form method='post' action='index.php?module=Projet&recherche=true' id='recherche'>
         <div class='form-group'>
            <label for='champRecherche' class='fondGold' > Rechercher </label> 
            <input type='text' name='champRecherche' id='champRecherche' class='form-control'/> 
         </div>
      </form>
      ";
    }

    public function affichePageProjet($req) {
        while(($line = $req->fetch()) !== false)
        {
            echo 
                "  
            <div class='row'>
               <a href='index.php?module=profil&nom=".$line['nom']."'>" . $line['nom'] . " " . $line['prenom'] . "</a>

            </div>
         ";
        }
    }

    public function affiche_navbar(){
        echo "
       <nav class='navbar navbar-expand-md '>

         <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
         </button>

         <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
               <li class='nav-item active'>
                  <a class='nav-link nav-border-white' href='index.php'>Profil <span class='sr-only'>(current)</span></a>
               </li>";

        if(count(func_get_args()) > 0)  {
            $args = func_get_args();
            echo "
               <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle nav-border-white' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Quêtes
                    </a>
                    <div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
            while(($line =  $args[0] -> fetch()) != false) {
                echo"
                        <a class='dropdown-item' href='index.php?module=projet&action=affiche&projet=". $line['idProjet'] ."'>" . $line['projet'] . "</a>";
            }
            echo "
                        <div class='dropdown-divider'>
                        </div>
                        <a class='dropdown-item' href='index.php?module=projet'>Créer une nouvelle quête</a>
                    </div>
                </li>";
        }
        else{
            echo"
                <li class='nav-item'>
                    <a class='nav-link' href='index.php?module=projet'>Quêtes</a>
                </li>";
        }
        echo " 
            </ul>
         ";

        if(isset($_SESSION['inscriptionFini'])){
            include_once 'modules/mod_recherche/mod_recherche.php';
            $modRecherche = new ModRecherche();
            $modRecherche -> action("recherche");
        } 

        echo "
         </div>
      </nav>
      ";
    }
}
?>
