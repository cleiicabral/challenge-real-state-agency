<?php

require_once "vendor/autoload.php";

require_once "app/routes/Router.php";

	try {

		$uri = parse_url($_SERVER["REQUEST_URI"])["path"];
		$request = $_SERVER["REQUEST_METHOD"];

		if (!isset($router[$request])) {
			throw new Exception("Method not permited");
		}

		if (!array_key_exists($uri, $router[$request])) {
			throw new Exception("Route not exist");
		}

		$controller = $router[$request][$uri];
		$controller();
	} catch (Exception $e) {
		echo $e->getMessage();
	}


