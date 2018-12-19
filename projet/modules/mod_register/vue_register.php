<?php
Class Vue_Register{
   public function __construct () {
  
   }

   private function miseEnPage() {
    echo "<div class='row'>
            <div class='col-md-8'>
            </div>
          <div class='col-md-4' id='registerDroit'>";
    
    
   }
   public function formulaire() {
    $this -> miseEnPage();
      echo  "<form method='post' action='index.php?module=register&action=formulaire' id='register'>
              <div class='form-group'>
                 <label id='id' for='champid'>Adresse-Mail</label> 
                 <input type='mail' name='id' id='champid'/> 
              </div>
              <div class='form-group'>
                 <label id='mdp' for='champmdp'>Mot de passe</label> 
                 <input type='password' name='mdp' id='champmdp' /> 
              </div>
              <div class='form-group'>
                 <label id='mdp2' for='champmdp'>Confirmer Mot de passe</label> 
                 <input type='password' name='mdp2' id='champmdp'/> 
              </div>
                 <input type='submit' value='Valider' id='valider'/>
            </form>";
      echo "</div>  
          </div>";
   }

   public function infoSupp($musique,$langage){
    $this -> miseEnPage();
    echo  "
          <form method='post' action='index.php?module=register&action=infosupp' id='register' enctype='multipart/form-data'>
            <div class='form-group'>
              <label for='champNom' id='id'> Nom </label> 
              <input type='text' name='champNom' id='champNom' class='form-control '/> 
            </div>

            <div class='form-group'>
              <label for='champPrenom' id='mdp'>Prenom</label> 
              <input type='text' name='champPrenom' id='champPrenom' class='form-control'/> 
            </div>

            <div class='form-group'>
              <label for='champAge' id='mdp2'>Age</label> 
              <input type='number' name='champAge' id='champAge' class='form-control '/> 
            </div>

            <div class='form-group'>
              <label for='champSexe'>Sexe</label>
                <select class='form-control' id='champSexe' name='champSexe'>;
                  <option value='Homme'>Homme</option>
                  <option value='Femme'>Femme</option>
                </select>
            </div>

            <div class='form-group'>
              <label for='champDesc' id='mdp2'>Description</label> 
              <input type='text' name='champDesc' id='champDesc' class='form-control'/> 
            </div>

            <div class='form-group'>
              <label for='champMusique'>Musique Préférée</label>
                <select class='form-control' name='champMusique' id='champMusique'>";
   
                  while(($line = $musique -> fetch()) !== false) {
                    echo "<option value='" .$line['musique'] . "''>" . $line['musique'] . "</option>";
                  }

    echo "      </select>
            </div>

            <div class='form-group'>
              <label for='champLangage'>Langage de Prédilection</label>
                <select class='form-control' id='champLangage' name='champLangage'> ";
                  while(($line = $langage -> fetch()) !== false) {
                    echo "<option value='" .$line['langage'] . "''>" . $line['langage'] . "</option>";
                  }

                  echo "      
                </select>
            </div>
            <div class='form-group' id='uploadImg'>
                Select image to upload:
                <input type='file' name='fileToUpload' id='fileToUpload'/>
            </div>  
            <input type='submit' value='Valider' id='valider'/>
        </form>";

    echo "</div>  
          </div>";
   }

   public function deconnexion(){
      echo  "<form method='post' action='index.php?module=connexion&action=deconnexion'>
             <input type='submit' value='deconnexion'/>
            </form>";
   }

   public function affichModifPass(){
      echo"
        <form method='post' action='index.php?module=register&action=resultModifPass'>
          <label for='email' class='font-weight-bold'>Votre E-mail :</label></br>
          <input id='email' type='text' name='email'/>
          <input type='submit' value='Valider'/>
        </form>
      ";
   }

   public function afficheResultModifPass($result){
      if($result){
        echo "Un E-Mail de changement de mot de passe a été envoyé";
      }else{
        echo "L'adresse saisie est éronnée";
      }
   }
}
?>


