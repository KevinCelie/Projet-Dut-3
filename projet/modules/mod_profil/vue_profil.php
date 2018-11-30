<?php
Class Vue_Profil{
   public function __construct () {
   }

   public function afficheProfil($req){
      $line = $req->fetch(); 
      echo "<div class='container' id='afficheProfil'>";
         echo "<div class='row ProfilRow'>";
            echo "<div class='ProfilChamp' id='NomPrenom'>";
               echo $line['nom']."  ".$line['prenom'];
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

      echo "</div>" ;
   }

   
}
?>

<div class ="row">

</div>