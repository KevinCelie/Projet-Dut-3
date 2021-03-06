<?php
include_once '../../bdd.php';

Class Modele_Profil extends BDD{

	public function __construct(){

	}

	public function getProfil($id){
		if ($id == null) {
			$id = $_SESSION['login'];
		}
		else {
			$reqChercheId = self::$DBH -> prepare("select * from Utilisateur where idUtilisateur = ");
			$reqChercheId -> execute(array($id));
			$line = $reqChercheId -> fetch();
			if ($line == true) {
				$id = $line['idUtilisateur'];
			}
		}
		$req = self::$DBH -> prepare("select * from Utilisateur inner join maitrise using (idUtilisateur) inner join ecoute using(idUtilisateur) where Utilisateur.idUtilisateur = ?");
		$req -> execute(array($id));
		return $req;
	}

	// public function getAmi($id){
	// 	$req = self::$DBH -> prepare("select * from sontAmis where (idUtilisateur = ? and idUtilisateur_sontAmis = ?) or (idUtilisateur = ? and idUtilisateur_sontAmis = ?)");
	// 	$req -> execute(array($id, $_SESSION['login'], $_SESSION['login'], $id));
	// }

	public function getAmi(){
		$args = func_get_args();
		if(count($args) == 0) {
			$req = self::$DBH -> prepare("select * from sontAmis inner join Utilisateur using(idUtilisateur) where idUtilisateur_sontAmis = ? and sontAmis= 0");
			$req -> execute(array($_SESSION['login']));
		}
		else {
			$req = self::$DBH -> prepare("select * from sontAmis inner join Utilisateur using(idUtilisateur) where (idUtilisateur = ? and idUtilisateur_sontAmis = ?) or (idUtilisateur = ? and idUtilisateur_sontAmis = ?)");
			$req -> execute(array($args[0], $_SESSION['login'], $_SESSION['login'], $args[0]));
		}
		return $req;
	}
    
    public function getMesQuetesPourInvitation($id){
        $req = self::$DBH -> prepare("select p1.idProjet, projet from Projet INNER JOIN appartientProjet as p1 USING(idProjet) LEFT JOIN appartientProjet as p2 ON p2.idUtilisateur = ? and p1.idProjet = p2.idProjet  WHERE p1.idUtilisateur = ? AND p2.idUtilisateur IS NULL");
        $req -> execute(array($id, $_SESSION['login']));
        return $req;
    }

	public function initConnexion(){
		$this ->connexion();
	}

	public function getTable(){
		return self::$DBH -> query("select * from php.profil;");
	}

	public function ajout($nom) {

		$req = self::$DBH -> prepare ("insert into php.profil values (default, ?)");
		$req -> execute(array($nom));
	}

	public function ajout_Ami($id){
		$reqSelect = self::$DBH -> prepare("select * from sontAmis where idUtilisateur = ? and idUtilisateur_sontAmis = ?");
		$reqSelect -> execute(array($id, $_SESSION['login']));
		$line = $reqSelect -> fetch();
			if ($line == true) {
				$reqUpdate = self::$DBH -> prepare("UPDATE sontAmis SET sontAmis = 1 where idUtilisateur = ? and idUtilisateur_sontAmis = ?");
				$reqUpdate -> execute(array($id,$_SESSION['login']));
			}else{
				$reqInsert = self::$DBH -> prepare("INSERT INTO sontAmis VALUES (?,?,0)");
				$reqInsert -> execute(array($_SESSION['login'], $id));
			}
			header("Location:index.php?module=profil&id=".$id);
	}

	public function getMusique() {
		$musique = self::$DBH -> query("select * from Musique;");
		return $musique;
	}
	public function getLangage() {
		$langage = self::$DBH -> query("select * from Langage;");
		return $langage;
	}

	public function updateProfil() {
		if($_SESSION['tokenVerif'] == $_POST['tokenVerif']){
			if (isset($_POST['champNom']) 
				&& isset($_POST['champPrenom']) 
				&& isset($_POST['champAge'])
				&& isset($_POST['champSexe'])
				&& isset($_POST['champDesc'])
				&& isset($_POST['champMusique'])
				&& isset($_POST['champLangage'])){

				$id = htmlspecialchars($_SESSION['login']);
				$nom = htmlspecialchars($_POST['champNom']);
				$prenom = htmlspecialchars($_POST['champPrenom']);
				$age = htmlspecialchars($_POST['champAge']);
				$sexe = htmlspecialchars($_POST['champSexe']);
				$desc = htmlspecialchars($_POST['champDesc']);
				$musique = htmlspecialchars($_POST['champMusique']);
				$langage = htmlspecialchars($_POST['champLangage']);

				var_dump($_FILES['fileToUpload']);

				//Upload image
				$target_dir = "uploads/";
				if($_FILES["fileToUpload"]["name"] != ""){
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				    if($check !== false) {
				        echo "File is an image - " . $check["mime"] . ".";
				        $uploadOk = 1;

				        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
						&& $imageFileType != "gif" ) {
						    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						    $uploadOk = 0;
						} 

						if ($_FILES["fileToUpload"]["size"] > 50000000) {
						    echo "Sorry, your file is too large.";
						    $uploadOk = 0;
						} 
				    } else {
				        echo "File is not afileToUploadn image.";
				        $uploadOk = 0;
				    }
					//*/
				    if ($uploadOk == 0) {
					    echo "Sorry, your file was not uploaded.";
					    $reqAnnul = self::$DBH -> prepare ("UPDATE Utilisateur set imageUtilisateur = 'uploads/default_img.png' where idUtilisateur = ?");
					    $reqAnnul -> execute(array($_SESSION['login']));
							// if everything is ok, try to upload file
					} else {
					   	if ($_FILES["fileToUpload"]["name"] != "" && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					        		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					   	} else {
					    	$reqAnnul = self::$DBH -> prepare ("UPDATE Utilisateur set imageUtilisateur = 'uploads/default_img.png' where idUtilisateur = ?");
					    	$reqAnnul -> execute(array($_SESSION['login']));
					       			echo "ERREEEEURzefazefzefzef";
					    }
					}
				}else{
					$info = $this -> getProfil($_SESSION['login']);
					$line = $info -> fetch();
					$target_file = $line['imageUtilisateur'];
				}
				
				// self::$DBH -> beginTransaction();
				$req = self::$DBH -> prepare ("update Utilisateur SET imageUtilisateur=?, nom=?, prenom=?, age=?, description=?, sexe=? where idUtilisateur=?");
				$req -> execute(array($target_file ,$nom, $prenom, $age, $desc, $sexe, $id));

				$req = self::$DBH -> prepare ("update ecoute SET musique = ? where idUtilisateur = ?");
				$req -> execute(array($musique, $id));

				$req = self::$DBH -> prepare ("update maitrise SET langage = ? where idUtilisateur = ?");
				$req -> execute(array($langage, $id));
			}else{
				echo "Veuillez verifier les champs";
				echo "nom" . isset($_POST['champNom'])  
				. "prenom" . isset($_POST['champPrenom']) 
				. "age" . isset($_POST['champAge'])
				. "sexe" . isset($_POST['champSexe'])
				. "desc" . isset($_POST['champDesc'])
				. "musique" . isset($_POST['champMusique'])
				. "langage" . isset($_POST['champLangage']);
			}
		}
	}


}
?>
