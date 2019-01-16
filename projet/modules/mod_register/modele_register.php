<?php
include_once '../../bdd.php';

Class Modele_Register extends BDD{

	public function __construct(){
	}

	public function initRegister(){
		$this ->connexion();
	}

	public function registerBD() {

		if ((isset($_POST['id']) && isset($_POST['mdp'])) && $_POST['mdp'] == $_POST['mdp2']) {

			$username = $_POST['id'];
			$password = crypt($_POST['mdp'], "admin");

			$req = self::$DBH -> prepare("insert into Identification values(DEFAULT, ?, ?, NULL)");
			$req -> execute(array($username, $password));

			if ($req == true) {
				$req1 = self::$DBH -> prepare ("select idUtilisateur from Identification where adresseMail=?");

				$req1 -> execute(array($username));
				$test1 = $req1 -> fetch();

				$_SESSION['login'] = $test1['idUtilisateur'];
			}else{
				echo "Erreur login déja utilisé";
			}
		}else{
			echo "Veuillez verifier les champs";
		}
	}
	public function registerInfoSuppBD() {
		if (isset($_POST['champNom']) 
			&& isset($_POST['champPrenom']) 
			&& isset($_POST['champAge'])
			&& isset($_POST['champSexe'])
			&& isset($_POST['champDesc'])
			&& isset($_POST['champMusique'])
			&& isset($_POST['champLangage'])){

			$id = $_SESSION['login'];
			$nom = $_POST['champNom'];
			$prenom = $_POST['champPrenom'];
			$age = $_POST['champAge'];
			$sexe = $_POST['champSexe'];
			$desc = $_POST['champDesc'];
			$musique = $_POST['champMusique'];
			$langage = $_POST['champLangage'];

			//Upload image
			$target_dir = "uploads/";
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
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
			//

			// self::$DBH -> beginTransaction();
			$req = self::$DBH -> prepare ("insert into Utilisateur values (?,?,?, ?, ?, ?, 1, ? )");
			$req -> execute(array($id, $target_file,$nom, $prenom, $age, $desc, $sexe));


			if ($req == true) {
				echo "COUCOU";
				$req1 = self::$DBH -> prepare("insert into ecoute values (?,?)");
				$req1 -> execute(array($id, $musique));
				$req2 = self::$DBH -> prepare("insert into maitrise values (?,?)");
				$req2 -> execute(array($id, $langage));

				if($req1 == true && $req2 == true) {
					$_SESSION['inscriptionFini'] = true;
					if ($uploadOk == 0) {
			    		echo "Sorry, your file was not uploaded.";
			    		$reqAnnul = self::$DBH -> prepare ("UPDATE Utilisateur set imageUtilisateur = 'uploads/default_img.png' where idUtilisateur = ?");
			       		$reqAnnul -> execute(array($_SESSION['login']));
					// if everything is ok, try to upload file
					} else {
			   			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			   			} else {
			       			$reqAnnul = self::$DBH -> prepare ("UPDATE Utilisateur set imageUtilisateur = 'uploads/default_img.png' where idUtilisateur = ?");
			       			$reqAnnul -> execute(array($_SESSION['login']));
			       			echo "ERREEEEURzefazefzefzef";
			    		}
			    	}
				}else{	
					echo "musique et langage CASSEEEEE";
				}
			}else{
				echo "ERRRRRRRRRRRRRREEEEEEUUUUUUURRRRRRRRRR";
			}
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

	public function getMusique() {
		$musique = self::$DBH -> query("select * from Musique;");
		return $musique;
	}
	public function getLangage() {
		$langage = self::$DBH -> query("select * from Langage;");
		return $langage;
	}

	public function modifPass(){
		$token = crypt(rand(0,999), "qeruneqy");
		mail("rafi01081999@gmail.com","YOLO","http://tvm.aop.ovh/index.php?module=register&action=verifMail&token=".$token);
		$req = self::$DBH -> prepare("UPDATE Identification SET resetToken = ? where adresseMail = ?");
		$req -> execute(array($token, $_POST['email']));
		if($req->rowCount()==1){
			return true;
		}else{
			return false;
		}
	}

	public function verifMail($token){
		$req = self::$DBH -> prepare("SELECT * from Identification where resetToken = ?");
		$req -> execute(array($token));
		$req -> fetch();
		echo $req;
	}
}
?>
