<?php
use Core\Route;
use Core\View;

define("PATH", getcwd());
define("S", DIRECTORY_SEPARATOR);

// include files
spl_autoload_register( function($classname) {
	$add = "";
	if( !in_array( reset( explode("\\", trim($classname, "\\") ) ), ["Core", "Controllers", "Models"] ) ) $add = "Libs".S;
	
	$path = realpath( PATH.S."application".S.$add.str_replace("\\", S, $classname ).".php");
	if($path)
		require_once($path);	
} );

//route
Route::add("/test/$1", "Controllers\Test@index"); 
Route::add("/", "Controllers\Test@index");
Route::add("", "Controllers\Test@index");
Route::start(); 
