<?php
Class Vue_Agenda{
    public function __construct(){

    }

    public function ajoutBoutonAjoutEvent(){
        echo "
        <button id='ajoutEvent' class='btn btn-primary'>
            Ajouter un évènement
        </button>

        <button id='modifEvent' class='btn btn-primary'>
            Modifier un évènement
        </button>

        <button id='suppEvent' class='btn btn-primary'>
            Supprimer un évènement
        </button>

        <script type='text/javascript'>
        $(document).ready(function(){
            $('#ajoutEvent').click(function(){
                idProjet = $('#divAjoutEvent').attr('projet');
                $.get('ajax_Agenda.php?action=formulaire_ajout&projet=1').done(function(resultat){
                    $('#divAjoutEvent').html(resultat);        
                });
            });
        });
        $(document).ready(function(){
            $('#modifEvent').click(function(){
                idProjet = $('#divAjoutEvent').attr('projet');
                $.get('ajax_Agenda.php?action=demande_modif&projet=1').done(function(resultat){
                    $('#divAjoutEvent').html(resultat);        
                });
            });
        });
        $(document).ready(function(){
            $('#suppEvent').click(function(){
                idProjet = $('#divAjoutEvent').attr('projet');
                $.get('ajax_Agenda.php?action=formulaire_supp&projet=1').done(function(resultat){
                    $('#divAjoutEvent').html(resultat);        
                });
            });
        });

        </script>
        ";
    }
    public function afficheBoutonRetour(){
        echo"
        <button id='retourEvent' class='btn btn-primary'>
            Retour
        </button>

        <script type='text/javascript'>
        $(document).ready(function(){
            $('#retourEvent').click(function(){
                $.get('ajax_Agenda.php?action=ajoutBoutonAjout&projet='+idProjet).done(function(resultat){
                        $('#divAjoutEvent').html(resultat);
                    }); 
            });
        });

        </script>
        ";    
    }

    public function afficheEvent($reqAgenda) {
        while(($event = $reqAgenda ->fetch()) != NULL){
            echo "
                        <tr>
                            <td class='agenda-date' class='active' rowspan='1'>
                            ".$event['dateDebut']." - ".$event['dateFin'] ."
                            </td>
                            <td class='agenda-time'>
                            ".$event['heureDebut']." - ".$event['heureFin'] ."
                            </td>
                            <td class='agenda-events'>
                                <div class='agenda-event'>
                                ".$event['description']."
                                </div>
                            </td>
                        </tr>

                        ";
        }
    }
    public function afficheAgenda($reqAgenda){
        echo "
        <p class='lead'>
            This agenda viewer will let you see multiple events cleanly!
        </p>
        <hr />
        <div class='agenda'>
            <div class='table-responsive'>
                <table class='table table-condensed table-bordered'>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Evenement</th>
                        </tr>
                    </thead>
                    <tbody id='bodyAgenda'>";
        $this->afficheEvent($reqAgenda);
        echo"
                    </tbody>
                </table>
            </div>
            <div id='divAjoutEvent' projet='".$_GET['projet']."'>
        ";
        $this->ajoutBoutonAjoutEvent();
        echo"
            </div>
        </div>";
    }

    public function afficheFormulaire(){
        echo "

            <div class='form-group row'>
                <label for='champDateDebut' class='col-sm-3 col-form-label'>
                    Date de début de l'Évenement :
                </label>
                <div class='col-sm-3'>
                    <input type='date' class='form-control' id='champDateDebut' name='champDateDebut'/>
                </div>
            </div>

            <div class='form-group row'>
                <label for='champDateFin' class='col-sm-3 col-form-label'>
                    Date de fin de l'Évenement :
                </label>
                <div class='col-sm-3'>
                    <input type='date' class='form-control' id='champDateFin' name='champDateFin'/>
                </div>
            </div>

            <div class='form-group row'>
                <label for='champHeureDebut' class='col-sm-3 col-form-label'>
                    Heure de debut de l'Évenement :
                </label>
                <div class='col-sm-3'>
                    <input type='time' class='form-control' id='champHeureDebut' name='champHeureDebut'/>
                </div>
            </div>

            <div class='form-group row'>
                <label for='champHeureFin' class='col-sm-3 col-form-label'>
                    Heure de fin de l'Évenement :
                </label>
                <div class='col-sm-3'>
                    <input type='time' class='form-control' id='champHeureFin' name='champHeureFin'/>
                </div>
            </div>

            <div class='form-group row'>
                <label for='champDesc' class='col-sm-3 col-form-label'>
                    Description :
                </label>
                <div class='col-sm-3'>
                    <textarea type='text' class='form-control' id='champDesc' name='champDesc'/>
                </div>
            </div>

            <input type='hidden' name='champProjet' id='champProjet' value='".$_GET['projet']."'/>

            <button type='valider' class='btn btn-primary' id='valideAjout'>Valider</button>

            <script type='text/javascript' src='script/ajoutEvent.js'></script>
        ";
        $this->afficheBoutonRetour();
    }

    public function afficheFormulaireSupp($reqAgenda) {
        echo"
        <div class='form-group row'>
            <label for='champChoix' class='col-sm-3 col-form-label'>
                Quel évènement voulez vous supprimer ? 
            </label>
            <div class='col-sm-3'>
                <select class='form-control' id='champChoix' name='champChoix'> ";
        while(($line = $reqAgenda -> fetch()) !== false) {
            echo "<option value='" .$line['idCalendrier'] . "''>" . $line['description'] . "</option>";
        }

        echo "      
                </select>
            </div>
        </div>

        <input type='hidden' name='champProjet' id='champProjet' value='".$_GET['projet']."'/>

        <button type='valider' class='btn btn-primary' id='valideSupp'>Valider</button>


        <script type='text/javascript' src='script/suppEvent.js'></script>
        ";
        $this->afficheBoutonRetour();
    }

    public function demandeModif($reqAgenda){
        echo"
        <div class='form-group row'>
            <label for='champChoixModif' class='col-sm-3 col-form-label'>
                Quel évènement voulez vous modifier? 
            </label>
            <div class='col-sm-3'>
                <select class='form-control' id='champChoixModif' name='champChoixModif'> ";
        while(($line = $reqAgenda -> fetch()) !== false) {
            echo "  <option value='" .$line['idCalendrier'] . "''>" . $line['description'] . "</option>";
        }

        echo "      
                </select>
            </div>
        </div>

        <input type='hidden' name='champProjet' id='champProjet' value='".$_GET['projet']."'/>

        <button type='valider' class='btn btn-primary' id='valideChoixModif'>Valider</button>

        <script type='text/javascript' src='script/choixModif.js'></script>
        ";
        $this->afficheBoutonRetour();
        echo"
        <div id='formulaireModif'></div>
        ";
        
    }

    public function afficheFormulaireModif($reqAgenda){
        $event = $reqAgenda->fetch();
        echo "

            <div class='form-group row'>
                <label for='champDateDebut' class='col-sm-3 col-form-label'>
                    Date de début de l'Évenement :
                </label>
                <div class='col-sm-3'>
                    <input type='date' class='form-control' id='champDateDebut' name='champDateDebut' value='".$event['dateDebut']."'/>
                </div>
            </div>

            <div class='form-group row'>
                <label for='champDateFin' class='col-sm-3 col-form-label'>
                    Date de fin de l'Évenement :
                </label>
                <div class='col-sm-3'>
                    <input type='date' class='form-control' id='champDateFin' name='champDateFin' value='".$event['dateFin']."'/>
                </div>
            </div>

            <div class='form-group row'>
                <label for='champHeureDebut' class='col-sm-3 col-form-label'>
                    Heure de debut de l'Évenement :
                </label>
                <div class='col-sm-3'>
                    <input type='time' class='form-control' id='champHeureDebut' name='champHeureDebut' value='".$event['heureDebut']."'/>
                </div>
            </div>

            <div class='form-group row'>
                <label for='champHeureFin' class='col-sm-3 col-form-label'>
                    Heure de fin de l'Évenement :
                </label>
                <div class='col-sm-3'>
                    <input type='time' class='form-control' id='champHeureFin' name='champHeureFin' value='".$event['heureFin']."'/>
                </div>
            </div>

            <div class='form-group row'>
                <label for='champDesc' class='col-sm-3 col-form-label'>
                    Description :
                </label>
                <div class='col-sm-3'>
                    <textarea type='text' class='form-control' id='champDesc' name='champDesc'>".$event['description']."</textarea>
                </div>
            </div>

            <input type='hidden' name='champProjet' id='champProjet' value='".$_GET['projet']."'/>
            <input type='hidden' name='champCalendrier' id='champCalendrier' value='".$event['idCalendrier']."'/>

            <button type='valider' class='btn btn-primary' id='valideModif'>Valider</button>

            <script type='text/javascript' src='script/modifEvent.js'></script>
        ";
        
    }
}
?>
