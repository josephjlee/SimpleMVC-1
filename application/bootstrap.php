<?php
use Core\Route;
use Core\View;

// include files
spl_autoload_register( function($classname) {
	$add = "";
	if( !in_array( reset( explode("\\", trim($classname, "\\") ) ), ["Core", "Controllers", "Models"] ) ) $add = "Libs/";
	
	$path = realpath( "application/".$add.str_replace("\\", "/", $classname ).".php" );
	if($path)
		require_once($path);	
} );

//route
Route::add("/test/:any", "Controllers\Test@index"); 
Route::add("/", "Controllers\Test@index");
Route::add("", "Controllers\Test@index");
Route::start(); 
