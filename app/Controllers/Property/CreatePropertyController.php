<?php

namespace App\Controllers\Property;

use App\Dtos\Property\CreatePropertyDto;
use App\Repositories\Property\PropertyRepository;
use App\Services\Property\CreatePropertyService;

class CreatePropertyController
{
	public function create($params)
	{
		try {
			$propertyRepository = new PropertyRepository();
			$createPropertyService = new CreatePropertyService($propertyRepository);
			$createPropertyDto = new CreatePropertyDto((array) $params);

			$property = $createPropertyService->create($createPropertyDto);

			return json_encode($property);
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}
}
