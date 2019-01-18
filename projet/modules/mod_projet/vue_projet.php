<?php
Class Vue_Projet{
    public function __construct () {
    }

    public function affiche_projet($reqProjet, $membreProjet, $estMembre){

        echo "

    <div id='accordion'>
        <div class='card'>
            <div class='card-header' id='headingOne'>
                <h5 class='mb-0'>
                    <button class='btn btn-link' data-toggle='collapse' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
                        Profil de la Quête
                    </button>
                </h5>
            </div>
            <div id='collapseOne' class='collapse show' aria-labelledby='headingOne' data-parent='#accordion'>
                <div class='card-body'>
                ";

        $this -> affiche_profil_projet($reqProjet, $membreProjet, $estMembre);

        echo "
                </div>
            </div>
        </div>

        <div class='card'>
            <div class='card-header' id='headingThree'>
                <h5 class='mb-0'>
                    <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapseThree' aria-expanded='false' aria-controls='collapseThree'>
                        Agenda de la Quête
                    </button>
                </h5>
            </div>
            <div id='collapseThree' class='collapse' aria-labelledby='headingThree' data-parent='#accordion'>
                <div class='card-body'>
            ";

        include_once('ajax_Agenda.php');


        echo"
                </div>
            </div>
        </div>
    </div>";



    }

    private function affiche_profil_projet($reqProjet, $membreProjet, $estMembre){
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
                            Lien GitHub :<a href='".$projet['lienGitHub']."'> ". $projet['lienGitHub'] ."</a>
                        </san>
                </div>
            </div>";    
        echo        "<div class='col-3'>
                <h2>Membres : </h2>
                <div class='list-group row' id='notifAmisList'>";

        while(($membre = $membreProjet -> fetch()) !== false) {

            echo "  <div class='list-group-item1'>
                        <a class='afficheProfilDemandeAmi' href='index.php?module=profil&id=".$membre['idUtilisateur']."'>".$membre['nom']." ".$membre['prenom']."</a>
                    </div>";
        }

        echo"
                </div>
            </div>
        </div>"; 
        if($estMembre){
            echo"
        <a href='index.php?module=projet&action=formulaireModif&projet=".$projet['idProjet']."'><button class='btn btn-primary'>Modifier Quête</button></a>
        ";
        }
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

    public function formulaireModif($infoProjet) {
        $projet = $infoProjet->fetch();
        $_SESSION['idProjet']=$projet['idProjet'];
        echo "
        <form method='post' action='index.php?module=projet&action=modification'>
            <div class='form-group row'>
                <label for='champProjet' class='col-sm-3 col-form-label'> Intitulé de votre Quête </label>
                <div class='col-sm-9'>
                    <input type='text' class='form-control' id='champProjet' name='champProjet' aria-describedby='emailHelp' value='".$projet['projet']."'>
                </div>
            </div>

            <div class='form-group row'>
                <label for='champDesc' class='col-sm-3 col-form-label'> Histoire de votre Quête </label>
                <div class='col-sm-9'>
                    <textarea type='text' class='form-control' id='champDesc' name='champDesc'>".$projet['projetDescription']."
                    </textarea>
                </div>
            </div>

            <div class='form-group row'>
                <label for='champGit' class='col-sm-3 col-form-label'> Lien GitHub </label>
                <div class='col-sm-9'>
                    <input type='text' class='form-control' id='champGit' name='champGit' value='".$projet['lienGitHub']."'/>
                </div>
            </div>

            <fieldset class='form-group'>
                <div class='row'>
                    <legend class='col-form-label col-sm-3 pt-0'>Secrète ?</legend>
                    <div class='col-sm-9'>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='champPrive' id='gridRadios1' value='True' ";
        if($projet['estPrive'] == 1)
            echo"checked";
        echo"
                            >
                            <label class='form-check-label' for='gridRadios1'>
                                Secrète
                            </label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='champPrive' id='gridRadios2' value='False'
                            ";

        if($projet['estPrive'] == 0)
            echo"checked";
        echo"
                            >
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