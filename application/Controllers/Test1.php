<?php
namespace Controllers;

use Core\Controller;
use Models\Test as Model;
use Core\View;

class Test1 extends Controller {
	 function __construct() {
			parent::__construct();
			$this->model = new Model();
			$this->view = new View();
	 }
	 
	 function index($a = null) {
		 $this->view->generate("test", array('PAGE_TITLE'=>'test'));
	 }
}
