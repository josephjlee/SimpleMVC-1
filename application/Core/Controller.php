<?php
namespace Core;

class Controller {
	public $model;
	public $view;
	private $host = "";
	private $dbname = "";
	private $user = "";
	private $pass = "";
	public $DB;
	
	function __construct() {
		//$this->DB = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
		session_start();
	}
	
	function __destruct () {
       //$this->DBH = null;
   }

	function index() {
		//
	}
}
