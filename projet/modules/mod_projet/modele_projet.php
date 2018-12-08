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

    public function creation_quete(){
        if (isset($_POST['champProjet']) 
            && isset($_POST['champDesc']) 
            && isset($_POST['champPrive'])) {

            $id = htmlspecialchars($_SESSION['login']);
            $titre = htmlspecialchars($_POST['champProjet']);
            $desc = htmlspecialchars($_POST['champDesc']);
            $prive = $_POST['champPrive'];
            $git = null;

            $req = self::$DBH -> prepare("insert into Projet values (DEFAULT, ?, ?, ?, NULL)");
            $req -> execute(array($titre, $desc, $prive));

            if($req == true) {
                $req2 = self::$DBH -> prepare("select * from Projet where projet = ? and projetDescription = ?");
                $req2 -> execute(array($titre, $desc));

                $line = $req2 -> fetch();

                $req3 = self::$DBH -> prepare("insert into appartientProjet values (?,?,True)");
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
    public function invite($projet, $profil){
        $req = self::$DBH -> prepare("insert into requeteProjet values (?,?,False)");
        $req -> execute(array($projet,$profil));
    }
    public function accepte($projet, $profil){
        $req = self::$DBH -> prepare("update requeteProjet set invitation = 1 where idProjet=? and idUtilisateur = ?");
        $req -> execute(array($projet,$profil));
        if($req == true) {
            $req = self::$DBH -> prepare("insert into appartientProjet values (?,?,False)");
            $req -> execute(array($projet,$profil));
        }
    }

}
?>
