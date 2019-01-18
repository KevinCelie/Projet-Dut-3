$('#valideChoixModif').click(function(){
    idProjet = $('#champProjet').val();
    idEvent = $('#champChoixModif').val();

    $.post("ajax_Agenda.php?action=formulaire_modif&projet="+idProjet, 
    {
        idCalendrier: idEvent
    }).done(function(resultat){
        $('#formulaireModif').html(resultat);
    });



});