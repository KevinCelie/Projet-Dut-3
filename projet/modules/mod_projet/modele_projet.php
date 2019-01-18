<?php
include_once '../../bdd.php';

Class Modele_Projet extends BDD{

    public function __construct(){

    }

    public function getProjet($id){
        $req = self::$DBH -> prepare("SELECT COUNT(idProjet) AS num FROM appartientProjet where idProjet = ?");
        $reussi = $req -> execute(array($id));
        if ($reussi == true) {
            $line = $req -> fetch();
            if ($line['num'] > 0) {
                $req = self::$DBH -> prepare("select * from appartientProjet inner join Projet using(idProjet) where idProjet = ?");
                $req -> execute(array($id));
                return $req;
            }
        }
        else return null;
    }

    public function getMembres($idProjet) {
        $req = self::$DBH -> prepare("SELECT idUtilisateur, nom, prenom FROM appartientProjet INNER JOIN Utilisateur USING(idUtilisateur) WHERE estRequete = 0 AND idProjet = ?");
        $req -> execute(array($idProjet));
        return $req;
    }
    
    public function estMembre(){
        $req = $this -> getMembres($_GET['projet']);
        while(($membre = $req -> fetch()) !== false){
            if($membre['idUtilisateur'] == $_SESSION['login'])
                return true;
        }
        return false;
            
        
    }




    public function creation_quete(){
        if (isset($_POST['champProjet']) 
            && isset($_POST['champDesc']) 
            && isset($_POST['champPrive'])) {

            $id = htmlspecialchars($_SESSION['login']);
            $titre = htmlspecialchars($_POST['champProjet']);
            $desc = htmlspecialchars($_POST['champDesc']);
            $prive = ($_POST['champPrive']==true)?1:0;
            $git = "";

            $req = self::$DBH -> prepare("insert into Projet values (DEFAULT, ?, ?, ?, NULL)");
            $req -> execute(array($titre, $desc, $prive));

            if($req == true) {
                $req2 = self::$DBH -> prepare("select * from Projet where projet = ? and projetDescription = ?");
                $req2 -> execute(array($titre, $desc));

                $line = $req2 -> fetch();

                $req3 = self::$DBH -> prepare("insert into appartientProjet values (?,?,True, False)");
                $req3 -> execute(array($line['idProjet'], $_SESSION['login']));
                if($req3 == true) {
                    echo "reussi";
                    return $line['idProjet'];
                }
                else{
                    echo "echec";
                }
            }
            else{
                echo "pb Champs";
            }


        }
    }
    
    public function modificationProjet() {
        $titre = htmlspecialchars($_POST['champProjet']);
        $desc = htmlspecialchars($_POST['champDesc']);
        $prive = ($_POST['champPrive']==true)?1:0;
        $git = htmlspecialchars($_POST['champGit']);
        $idProjet = htmlspecialchars($_POST['champId']);
        $req = self::$DBH -> prepare("update Projet set projet=?, projetDescription=?, estPrive=?, lienGitHub=? where idProjet=?");
        $req->execute(array($titre,$desc,$prive,$git,$idProjet));
    }
    
    public function invite($projet, $profil){
        $req = self::$DBH -> prepare("insert into appartientProjet values (?,?,False, True)");
        $req -> execute(array($projet,$profil));
    }
    
    public function accepte($projet, $profil){
        $req = self::$DBH -> prepare("update appartientProjet set estRequete = 0 where idProjet=? and idUtilisateur = ?");
        $req -> execute(array($projet,$profil));
    }

}
?>
