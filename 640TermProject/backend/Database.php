<?php

class Database extends mysqli {
	// Holds the database connection
	protected $db;

	// Database connection details
	protected $logonInfo = array(
		'hostname' => 'sfsuswe.com',
		'username' => 's14g01',
		'password' => 'ILoveProductionDBs',
		'database' => 'student_s14g01'
	);

	// Constructor
	function __construct(){
		parent::__construct(
			$this->logonInfo['hostname'],
			$this->logonInfo['username'],
			$this->logonInfo['password'],
			$this->logonInfo['database']
		);

		// If the database connection could not be established
		if($this->error){
			die("Could not connect to database");
		}
	}
}
?>
