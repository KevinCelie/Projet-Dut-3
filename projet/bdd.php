<?php
Class BDD{
	protected static $bdd;
	public static $DBH;

	public static function connexion(){
		// $option = array(
  //           'unix_socket' => '/var/run/mysqld/mysqld.sock',
  //       );

		try {
			self::$bdd='mysql:host=database-etudiants.iut.univ-paris8.fr; dbname=dutinfopw201639';
			$user = 'dutinfopw201639';
			$password = 'qeruneqy';
   			self::$DBH = new PDO(self::$bdd, $user, $password/*, $option*/);
 		} catch (PDOException $e) {
   			echo 'Connexion échouée : ' . $e->getMessage();
		}
	}
}
?>
