<?php
include_once 'bdd.php';

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

			$req = self::$DBH -> query("insert into Identification values(DEFAULT, '" . $username . "', '" . $password ."')");

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
			&& isset($_POST['champLangage'])) {

			$id = $_SESSION['login'];
			$nom = $_POST['champNom'];
			$prenom = $_POST['champPrenom'];
			$age = $_POST['champAge'];
			$sexe = $_POST['champSexe'];
			$desc = $_POST['champDesc'];
			$musique = $_POST['champMusique'];
			$langage = $_POST['champLangage'];

			echo $id . $nom . $prenom . $age .$desc . $sexe;

			// self::$DBH -> beginTransaction();
			$req = self::$DBH -> prepare ("insert into Utilisateur values (?,'',?, ?, ?, ?, 1, ? )");
			$req -> execute(array($id, $nom, $prenom, $age, $desc, $sexe));


			if ($req == true) {
				echo "COUCOU";
				$req1 = self::$DBH -> prepare("insert into ecoute values (?,?)");
				$req1 -> execute(array($id, $musique));
				$req2 = self::$DBH -> prepare("insert into maitrise values (?,?)");
				$req2 -> execute(array($id, $langage));

				if($req1 == true && $req2 == true) {
					$_SESSION['inscriptionFini'] = true;
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
		$token = rand(0,999);
		$req = self::$DBH -> prepare("select adresseMail from Identification where adresseMail = ?");
		$req -> execute(array($_POST['email']));
		$test = $req -> fetch();

		if($test == true){		
			$req = self::$DBH -> prepare("UPDATE Identification SET resetToken = ? where adresseMail = ?");
			$token = crypt($token, "Changepassword");
			$req -> execute(array($token ,$_POST['email']));

			if($req == true){
				mail("rauriac@iut.univ-paris8.fr", "YEYY", "YYYETTTT");
			}else{
				return false;
			}

		}else{
			return false;
		}
	}
}
?>