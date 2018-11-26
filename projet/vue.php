<?php
class Vue {
   // public function __construct () {
   // }

   // public function menu(){
   // }

   public function bienvenue(){
   	 echo "Bienvenue<br/>";
   }

   public function affichQuery($query){
   	while(($line = $query->fetch()) !== false){
		echo $line['idcom'] . $line['username'] . "<br/>";
	
    }
	}
}
?>