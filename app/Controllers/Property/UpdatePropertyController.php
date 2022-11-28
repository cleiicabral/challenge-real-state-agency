<?php

namespace App\Controllers\Property;

use App\Dtos\Property\UpdatePropertyDto;
use App\Services\Property\UpdatePropertyService;
use App\Repositories\Property\PropertyRepository;

class UpdatePropertyController
{
	public function update($params)
	{
		try {
			$propertyRepository = new PropertyRepository();
			$service = new UpdatePropertyService($propertyRepository);
			$propertyDto = new UpdatePropertyDto((array) $params);
			$property = $service->update($params->id, $propertyDto);
			return json_encode($property);
		} catch (\Throwable $th) {
			return json_encode($th->getMessage());
		}
	}
}
