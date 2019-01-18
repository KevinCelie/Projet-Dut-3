$('#valideSupp').click(function(){
    idProjet = $('#champProjet').val();
    idEvent = $('#champChoix').val();
    
            $.post("ajax_Agenda.php?action=supprimer&projet="+idProjet, 
            {
                idEvent: idEvent
            }).done(function(result){
                
                $.get('ajax_Agenda.php', {action:'refreshAgenda', projet:idProjet}).done(function(resultat){
                    $('#bodyAgenda').html(resultat);
                    $.get("ajax_Agenda.php?action=ajoutBoutonAjout&projet="+idProjet).done(function(resultat){
                        $('#divAjoutEvent').html(resultat);
                    });
                });
                
                

            });
});