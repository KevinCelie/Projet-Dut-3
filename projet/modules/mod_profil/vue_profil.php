<?php
Class Vue_Profil{
   public function __construct () {
   }

   public function afficheProfil(){
      $args = func_get_args();
      $line = $args[0]->fetch(); 
      echo "<div class='row'>";
         echo "<div class='col-9' id='afficheProfil'>";
            echo "<div class='row ProfilRow'>";
               echo "<div class='ProfilChamp row'>";
                  echo "<img src='".$line['imageUtilisateur']."' id='imageProfil'>";
                  echo "<div class='col-8  text-nowrap' id='NomPrenom'>";
                  echo $line['nom']."  ".$line['prenom']." ";
               echo "</div>";
               if($_SESSION['login'] != $line['idUtilisateur']){
                  $line2 = $args[1]->fetch();
                  if($line2 == False){
                     echo "<div class='col-4 text-nowrap'><a id='ajouterAmiButton' href='index.php?module=profil&action=ami&id=".$line['idUtilisateur']."'> Ajouter en Ami </a></div>";
                  }else{
                     if($line2['sontAmis'] == 0){
                       if($line2['idUtilisateur'] == $_SESSION['login']){
                              echo "<div class='col-4 text-nowrap'><a id='ajouterAmiButton'> Demande envoyée </a></div>";
                           }else{
                              echo "<div class='col-4 text-nowrap'><a id='ajouterAmiButton' href='index.php?module=profil&action=ami&id=".$line['idUtilisateur']."'> Accepter la demande </a></div>";
                           }
                        }else {
                           if($args[2] == True) {
                              echo "
                              <div class='dropdown'>
                                  <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                      Inviter à une quête
                                  </button>
                                  <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                              while(($quete =$args[2] -> fetch()) !=False ) {
                                  echo "<a class='dropdown-item' href='index.php?module=projet&action=invite&projet=". $quete['idProjet'] ."&profil=" . $line['idUtilisateur'] . "'>" . $quete['projet'] . "</a>";
                              }
                              echo"</div>
                              </div>";
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
               echo "<a href='index.php?module=profil&action=modifier' id='modifierProfilButton'>Modifier Profil</a>";
         echo "</div>" ;

         /*Notif des amis*/
         if($_SESSION['login'] == $line['idUtilisateur']){
               echo "<div class='col-3' id='notifAmis'>";
               echo"<div class='list-group row' id='notifAmisList'>";
                  while(($line = $args[1] -> fetch()) !== false) {
                    
                     echo "<div class='list-group-item1'>";
                     echo "<a class='afficheProfilDemandeAmi' href='index.php?module=profil&id=".$line['idUtilisateur']."'>".$line['nom']." ".$line['prenom']."</a><a  href='index.php?module=profil&action=ami&id=".$line['idUtilisateur']."'><img class='addFriendButton' src='addFriend.jpeg' height='17' width='17'></a>";
                     echo"</div>";
                  }
                 
               echo"</div>";
            echo "</div>";
         }
      echo "</div>";
   }

   public function modifProfil($req, $musique, $langage){
      $champNom = array("Nom","Prenom", "Âge", "Description","Sexe");
      echo "<div class='row'>";
      $champId = array("champNom", "champPrenom", "champAge", "champDesc", "champSexe");

         echo "<div class='col-4' id='modifProfil'>";
            $i = 0;
            $info = $req -> fetch();
            echo "<form method='post' action='index.php?module=profil&action=updateProfil' id='updateProfil' enctype='multipart/form-data'>";
               while($i < 5){
                  if($champNom[$i] == "Sexe"){
                     echo "<div class = 'form-group'>";
                        echo "Sexe";
                        echo "<select ".$info[7]." class='form-control' id='champSexe' name='champSexe'>;
                           <option value='Homme'>Homme</option>
                           <option value='Femme'>Femme</option>
                        </select>";
                     echo "</div>";
                  }else{
                     echo "<div class = 'form-group'>";
                        echo $champNom[$i];
                       echo "<input value ='".$info[$i+2]."' type = 'text' name='".$champId[$i]."' id='".$champId[$i]."' class='form-control'/>";
                     echo "</div>";
                  }
                  $i = $i + 1;
               }

               echo "<div class='form-group'>
                 <label for='champMusique'>Musique Préférée</label>
                   <select class='form-control' name='champMusique' id='champMusique'>";
      
                     while(($line = $musique -> fetch()) !== false) {

                       echo "<option value='" .$line['musique'] . "'";
                        if($info[9] == $line['musique']){
                              echo " selected";
                        }
                       echo ">" . $line['musique'] . "</option>";
                     }

                  echo "</select>
               </div>

               <div class='form-group'>
                 <label for='champLangage'>Langage de Prédilection</label>
                   <select selected='".$info[8]."' class='form-control' id='champLangage' name='champLangage'> ";
                     while(($line = $langage -> fetch()) !== false) {
                       echo "<option value='" .$line['langage'] . "'";
                        if($info[8] == $line['langage']){
                              echo " selected";
                        }
                       echo ">" . $line['langage'] . "</option>";
                     }

                  echo "      
                   </select>";
               echo "</div>";
            echo "</div>";
            echo "<div class='col-4'>";
               echo "<img src='".$info['imageUtilisateur']."' id='imageProfil'>";

               echo "<div class='form-group' id='uploadImg'>
                        Select image to upload:
                     <input type='file' name='fileToUpload' id='fileToUpload'/>
               </div>";
               echo "<input type='submit' value='Valider' id='valider'/>";
            echo "</div>";
         echo "</form>";
      echo "</div>";
   }
}
?>