<?php
Class Vue_Profil{
   public function __construct () {
   }

   public function afficheProfil($req){
      $line = $req->fetch(); 
      echo "<div class='container' id='afficheProfil'>";
         echo "<div class='row ProfilRow'>";
            echo "<div class='ProfilChamp row'>";
               if($_SESSION['login'] == $line['idUtilisateur']){
                  echo "<div class='col-8' id='NomPrenom'>";
                     echo $line['nom']."  ".$line['prenom'];
                  echo "</div>";
               }else{
                  echo "<div class='col-8' id='NomPrenom'>";
                  echo $line['nom']."  ".$line['prenom']."</div><div class='col-4 text-nowrap'><a id='ajouterAmiButton' href='index.php?module=profil&action=ami&id=".$line['idUtilisateur']."'>Ajouter en Ami</a></div>";
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
   }

   
}
?>