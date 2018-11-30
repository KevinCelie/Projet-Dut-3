<?php
Class BDD{
	protected static $bdd;
	public static $DBH;

	public static function connexion(){
		// $option = array(
  //           'unix_socket' => '/var/run/mysqld/mysqld.sock',
  //       );

		try {
			self::$bdd='mysql:host=localhost; dbname=dutinfopw201639';
			$user = 'root';
			$password = 'qeruneqy42';
   			self::$DBH = new PDO(self::$bdd, $user, $password/*, $option*/);
 		} catch (PDOException $e) {
   			echo 'Connexion échouée : ' . $e->getMessage();
		}
	}
}
?>
