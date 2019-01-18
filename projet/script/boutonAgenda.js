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