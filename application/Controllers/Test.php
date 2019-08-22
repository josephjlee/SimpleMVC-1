<?php
namespace Controllers;

use Core\Controller;
use Models\Test as Model;
use Core\View;
use Others\My;

class Test extends Controller {
	 function __construct() {
			parent::__construct();
			$this->model = new Model();
			$this->view = new View();
	 }
	 
	 function index($a = null) {
		 My::hello();
		 echo "action $a<br>";
		 $this->view->generate("test", array('PAGE_TITLE'=>'test'));
	 }
}
