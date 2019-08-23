<?php
namespace Core;


class Route
{
	public static $routes = array();
	public static $requestedUrl = null;
	public static $requestedUrlArr = array();
	public static $param = null;
	public static $auto = true;
	
	
	public static function add($route, $handle = null) {
		if ($handle != null && !is_array($route))
			$route = array($route => $handle);
		self::$routes = array_merge(self::$routes, $route);
	}
	
	public static function start($requestedUrl = null) {
		if ($requestedUrl === null) {
			$uri = reset(explode('?', $_SERVER["REQUEST_URI"]));
			$requestedUrl = urldecode(rtrim($uri, '/'));
		}

		self::$requestedUrl = $requestedUrl;
		if (isset(self::$routes[$requestedUrl])) {
			return self::execute(self::$routes[$requestedUrl]);
		}

		self::$requestedUrlArr = $arr = explode("/", $requestedUrl);
		$param = end($arr);
		array_pop($arr);
		$url = implode("/", $arr)."/:any";
		if( isset(self::$routes[$url]) ) {
			self::$param = $param;
			return self::execute(self::$routes[$url]);
		}

		if(self::$auto) return self::auto();
		
		Route::errorPage404();
	}
	public static function execute($handle) {
		if ( is_callable($handle) ) {
			return $handle(self::$param);
        }
		
		$handle = explode("@", $handle);
		if( count($handle) > 2 ) return;
		else if($handle[1] == null) $handle[1] = "index";
		if ( class_exists($handle[0]) ) {
			$controller = new $handle[0];
			if ( method_exists($controller, $handle[1]) ){
				return $controller -> $handle[1](self::$param);
			}
		}
	}
	public static function auto()
	{
		$controller_name = 'Main';
		$action_name = 'index';

		if ( !empty(self::$requestedUrlArr[1]) )
			$controller_name = self::$requestedUrlArr[1];
		
		if ( !empty(self::$requestedUrlArr[2]) )
			$action_name = self::$requestedUrlArr[2];
	
		$controller_name = "Controllers\\".ucfirst(strtolower($controller_name));

		if ( class_exists($controller_name) ){
			$controller = new $controller_name;
			if ( method_exists($controller, $action_name) )
				$controller->$action_name();
			else 
				Route::errorPage404();
		} else 
			Route::errorPage404();
	}
	
	public static function errorPage404()
	{
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		echo '404';
		exit();
    }  
}
