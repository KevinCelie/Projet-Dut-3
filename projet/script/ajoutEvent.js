$('#valideAjout').click(function(){
    idProjet = $('#champProjet').val();
    dateDebut = $('#champDateDebut').val();
    dateFin = $('#champDateFin').val();
    heureDebut = $('#champHeureDebut').val();
    heureFin = $('#champHeureFin').val();
    desc = $('#champDesc').val();
    if(dateDebut!='' && dateFin!=''&& heureDebut!=''&&heureFin!=''&&desc!=''){
        if(dateDebut<dateFin || (dateDebut==dateFin && heureDebut <=heureFin)){
            $.post("ajax_Agenda.php?action=ajouter&projet="+idProjet, 
                   {
                champDateDebut: dateDebut,
                champDateFin: dateFin,
                champHeureDebut: heureDebut,
                champHeureFin: heureFin,
                champDesc: desc
            }).done(function(){
                $.get('ajax_Agenda.php', {action:'refreshAgenda', projet:idProjet}).done(function(resultat){
                    $('#bodyAgenda').html(resultat);
                    $.get("ajax_Agenda.php?action=ajoutBoutonAjout&projet="+idProjet).done(function(resultat){
                        $('#divAjoutEvent').html(resultat);
                    });
                });

            });

        }
    }
});

