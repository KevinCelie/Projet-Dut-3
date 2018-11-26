<?php
include_once 'bdd.php';

Class Modele_joueur extends BDD{

	public function __construct(){
	}

	public function getList(){
		return $tab = array (array("id"=>1, "nom"=>"Zidane"), array("id"=>2, "nom"=> "Henry"), array("id"=>3, "nom"=>"Mbappé"), array("id"=>4, "nom"=>"Rami" ));
	}

	public function initConnexion(){
		$this ->connexion();
	}

	public function getTable(){
		return self::$DBH -> query("select * from php.joueur;");
	}

	public function ajout($nom) {

		$req = self::$DBH -> prepare ("insert into php.joueur values (default, ?)");
		$req -> execute(array($nom));
	}


}
?>