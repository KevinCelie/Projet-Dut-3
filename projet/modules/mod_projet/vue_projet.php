<?php
Class Vue_Projet{
    public function __construct () {
    }

    public function affiche_projet($reqProjet, $membreProjet){
        $projet = $reqProjet -> fetch();
echo "
        <div class='row'>
            <div class='col-9'>
                <div>
                    <h1>
                    ". $projet['projet'] ."
                    </h1>
                </div>
                <div>
                        <p>
                            Histoire : </br>". $projet['projetDescription'] ."
                        </p>
                </div>
                <div>
                        <span>
                            Lien GitHub :". $projet['lienGitHub'] ."
                        </span>
                </div>
            </div>";    
echo        "<div class='col-3'>
                <h2>Membres : </h2>
                <div class='list-group row' id='notifAmisList'>";
        
        while(($membre = $membreProjet -> fetch()) !== false) {
                    
echo "              <div class='list-group-item1'>
                        <a class='afficheProfilDemandeAmi' href='index.php?module=profil&id=".$membre['idUtilisateur']."'>".$membre['nom']." ".$membre['prenom']."</a>
                    </div>";
                  }
                 
echo"           </div>
            </div>
        </div>

      ";
    }

    /*redirige vers module -> projet et action -> creation*/
    public function affiche_page_creation_projet() {
        echo "
            <form method='post' action='index.php?module=projet&action=creation'>
                <div class='form-group row'>
                    <label for='champProjet' class='col-sm-3 col-form-label'> Intitulé de votre Quête </label>
                    <div class='col-sm-9'>
                        <input type='text' class='form-control' id='champProjet' name='champProjet' aria-describedby='emailHelp' placeholder='Intitulé...'>
                    </div>
                </div>

                <div class='form-group row'>
                    <label for='champDesc' class='col-sm-3 col-form-label'> Histoire de votre Quête </label>
                    <div class='col-sm-9'>
                        <textarea type='text' class='form-control' id='champDesc' name='champDesc' placeholder='Raconter votre quête...'></textarea>
                    </div>
                </div>

                <fieldset class='form-group'>
                    <div class='row'>
                        <legend class='col-form-label col-sm-3 pt-0'>Secrète ?</legend>
                        <div class='col-sm-9'>
                            <div class='form-check'>
                                <input class='form-check-input' type='radio' name='champPrive' id='gridRadios1' value='True' checked>
                                <label class='form-check-label' for='gridRadios1'>
                                    Secrète
                                </label>
                            </div>
                            <div class='form-check'>
                                <input class='form-check-input' type='radio' name='champPrive' id='gridRadios2' value='False'>
                                <label class='form-check-label' for='gridRadios2'>
                                    Public
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button type='submit' class='btn btn-primary'>Valider</button>
            </form>



      ";
    }

}
?>