<?php
Class BDD{
	protected static $bdd;
	public static $user;
	public static $password;
	public static $DBH;



	public static function connexion(){

		self::$bdd='pgsql: host=database-etudiants.iut.univ-paris8.fr; dbname=rauriac';
		self::$user = 'rauriac';
		self::$password = '';

		try {
   			self::$DBH = new PDO(self::$bdd, self::$user, self::$password);
 		} catch (PDOException $e) {
   		 echo 'Connexion échouée : ' . $e->getMessage();
		}
	}
}
?>