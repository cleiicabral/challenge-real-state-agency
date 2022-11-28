<?php

namespace App\routes;

use Exception;
use App\Controllers\Client\IndexClientController;
use App\Controllers\Client\CreateClientController;
use App\Controllers\Property\IndexPropertyController;
use App\Controllers\Contract\CreateContractController;
use App\Controllers\Property\CreatePropertyController;
use App\Controllers\PropertyOwner\IndexPropertyOwnerController;
use App\Controllers\PropertyOwner\CreatePropertyOwnerController;
use App\Controllers\PropertyOwner\CretaePropertyOwnerController;

function load(string $controller, string $action): void
{
    try {
        // se controller existe
        $controllerNamespace = $controller;

        if (!class_exists($controllerNamespace)) {
            throw new Exception("Controller {$controller} not exist");
        }

        $controllerInstance = new $controllerNamespace();

        if (!method_exists($controllerInstance, $action)) {
            throw new Exception(
                "Method {$action} not exist in controller {$controller}"
            );
        }

        $result = $controllerInstance->$action((object) $_REQUEST);

		echo $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

$router = [
  "GET" => [
    "/clients/index" => fn () => load(IndexClientController::class, "index"),
	"/property_owner/index" => fn () => load(IndexPropertyOwnerController::class, "index"),
	"/property/index" => fn () => load(IndexPropertyController::class, "index")
 ],
  "POST" => [
	"/clients/create" => fn () => load(CreateClientController::class, "create"),
	"/clients/update" => fn () => load(CreateClientController::class, "update"),
	"/property_owner/create" => fn () => load(CreatePropertyOwnerController::class, "create"),
	"/property/create" => fn () => load(CreatePropertyController::class, "create"),
	"/contracts/create" => fn () => load(CreateContractController::class, "create"),
  ]
];
