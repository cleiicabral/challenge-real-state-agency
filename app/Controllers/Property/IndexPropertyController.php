<?php

namespace App\Controllers\Property;

use App\Services\Property\IndexPropertyService;
use App\Repositories\Property\PropertyRepository;

class IndexPropertyController
{
	public function index()
	{
		try {
			$propertyRepository = new PropertyRepository();
			$service = new IndexPropertyService($propertyRepository);
			$properties = $service->index();
			var_dump($properties);
			return json_encode($properties);
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}
}
