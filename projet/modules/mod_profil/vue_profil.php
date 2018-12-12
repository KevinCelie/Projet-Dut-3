<?php
Class Vue_Profil{
   public function __construct () {
   }

   public function afficheProfil($req, $req2){
      $line = $req->fetch(); 
      echo "<div class='row'>";
         echo "<div class='col-9' id='afficheProfil'>";
            echo "<div class='row ProfilRow'>";
               echo "<div class='ProfilChamp row'>";
                  echo "<div class='col-8 text-nowrap' id='NomPrenom'>";
                     echo $line['nom']."  ".$line['prenom']." ";
                  echo "</div>";
                  if($_SESSION['login'] != $line['idUtilisateur']){
                     $line2 = $req2->fetch();
                     if($line2 == False){
                        echo "<div class='col-4 text-nowrap'><a id='ajouterAmiButton' href='index.php?module=profil&action=ami&id=".$line['idUtilisateur']."'> Ajouter en Ami </a></div>";
                     }else{
                        if($line2['sontAmis'] == 0){
                           if($line2['idUtilisateur'] == $_SESSION['login']){
                              echo "<div class='col-4 text-nowrap'><a id='ajouterAmiButton'> Demande envoyée </a></div>";
                           }else{
                              echo "<div class='col-4 text-nowrap'><a id='ajouterAmiButton' href='index.php?module=profil&action=ami&id=".$line['idUtilisateur']."'> Accepter la demande </a></div>";
                           }
                        }
                     }
                  }   
               echo "</div>";
            echo "</div>";

            echo "<div class='row ProfilRow'>";
               echo "<div id='ProfilAge'>";
                  echo "<div class='ProfilNomChamp'>";
                     echo "<span>Âge :</span>";
                  echo "</div>";
                  echo "<div class='ProfilChamp'>";
                     echo $line['age'];
                  echo "</div>";   
               echo "</div>";
            echo "</div>";

            echo "<div class='row ProfilRow'>";
               echo "<div id='ProfilDescription'>";
                  echo "<div class='ProfilNomChamp'>";
                     echo "Description :";
                  echo "</div>";
                  echo "<div class='ProfilChamp'>";
                     echo $line['description'];
                  echo "</div>";
               echo "</div>";
            echo "</div>";

            echo "<div class='row ProfilRow'>";
               echo "<div id='ProfilVitesseTapping'>";
                  echo "<div class='ProfilNomChamp'>";
                     echo "Vitesse de Tapping :";
                  echo "</div>";
                  echo "<div class='ProfilChamp'>";
                     echo $line['vitesseTapping'];
                  echo "</div>";
               echo "</div>";
            echo "</div>";

            echo "<div class='row ProfilRow'>";
               echo "<div id='ProfilSexe'>";
                  echo "<div class='ProfilNomChamp'>";
                     echo "Sexe :";
                  echo "</div>";
                  echo "<div class='ProfilChamp'>";
                     echo $line['sexe'];
                  echo "</div>";
               echo "</div>";
            echo "</div>";

            echo "<div class='row ProfilRow'>";
               echo "<div id='ProfilLangage'>";
                  echo "<div class='ProfilNomChamp'>";
                     echo "Langage de prédilection:";
                  echo "</div>";
                  echo "<div class='ProfilChamp'>";
                     echo $line['langage'];
                  echo "</div>";
               echo "</div>";
            echo "</div>";

            echo "<div class='row ProfilRow'>";
               echo "<div id='ProfilMusique'>";
                  echo "<div class='ProfilNomChamp'>";
                     echo "Style de Musique :";
                  echo "</div>";
                  echo "<div class='ProfilChamp'>";
                     echo $line['musique'];
                  echo "</div>";
               echo "</div>";
            echo "</div>";
         echo "</div>" ;

         /*Notif des amis*/
         if($_SESSION['login'] == $line['idUtilisateur']){
            echo "<div class='col-3' id='notifAmis'>";
               echo"<div class='list-group row' id='notifAmisList'>";
                  while(($line = $req2 -> fetch()) !== false) {
                    echo "<div class='list-group-item1'>".$line['nom']." ".$line['prenom']."<img class='addFriendButton' src='addFriend.jpeg' height='17' width='17' href='index.php?module=profil&action=ami&id=".$line['idUtilisateur']."'></div>";/*LA FONCTION D'UPDATE MARCHE PLUS*/
                  }
                 
               echo"</div>";
            echo "</div>";
         }
      echo "</div>";
   }
}
?>