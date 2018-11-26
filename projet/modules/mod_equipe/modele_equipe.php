<?php
include_once 'bdd.php';

Class Modele_Equipe extends BDD{

	public function __construct(){
	}

	public function getList(){
		return $tab = array (array("id"=>1, "nom"=>"FC Barcelone"), array("id"=>2, "nom"=> "PSG"), array("id"=>3, "nom"=>"Real Madrid"), array("id"=>4, "nom"=>"OM" ));
	}

	public function initConnexion(){
		$this ->connexion();
	}

	public function getTable(){
		return self::$DBH -> query("select * from comments");
	}
}
?>