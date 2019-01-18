<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">

<h2>Agenda</h2>
    <p class="lead">
        This agenda viewer will let you see multiple events cleanly!
    </p>
    

    <hr />
    <div class="agenda">
        <div class="table-responsive">
            <table class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Evenement</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include "../../bdd.php";
                    BDD::connexion();
                    $req = BDD::$DBH -> prepare("select * from aEvent natural join Evenement where idCalendrier = 1");
                    $req -> execute();
                    while(($event = $req ->fetch()) != NULL){
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
                                ".
                        $event['description']
                            ."
                            </div>
                        </td>
                    </tr>
                        
                        ";
                    }
                ?>
                    <!-- Single event in a single day -->
                    
                    <!-- Multiple events in a single day (note the rowspan) -->
                    <!--<tr>
                        <td class="agenda-date" class="active" rowspan="3">
                            <div class="dayofmonth">24</div>
                            <div class="dayofweek">Thursday</div>
                            <div class="shortdate text-muted">July, 2014</div>
                        </td>
                        <td class="agenda-time">
                            8:00 - 9:00 AM 
                        </td>
                        <td class="agenda-events">
                            <div class="agenda-event">
                                Doctor's Appointment
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="agenda-time">
                            10:15 AM - 12:00 PM 
                        </td>
                        <td class="agenda-events">
                            <div class="agenda-event">
                                Meeting with executives
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="agenda-time">
                            7:00 - 9:00 PM
                        </td>
                        <td class="agenda-events">
                            <div class="agenda-event">
                                Aria's dance recital
                            </div>
                        </td>
                    </tr>-->
                </tbody>
            </table>
        </div>
    </div>
</div>
