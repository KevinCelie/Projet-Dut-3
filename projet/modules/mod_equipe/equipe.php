<?php
Class Equipe{
	public id;
	public static pK = 0;
	public nom;
	public description;
	public pays;
	public logo;

	public function __construct($nom_, $description_, $pays_, $logo_){
		$this -> id = pK++;
		$this -> nom = $nom_;
		$this -> description = $description_;
		$this -> pays = $pays_;
		$this -> logo = $logo_;
	}
}
?>