<?php

namespace App\Controllers\PropertyOwner;

use App\Dtos\PropertyOwner\CreatePropertyOwnerDto;
use App\Services\PropertyOwner\CreatePropertyOwnerService;
use App\Repositories\PropertyOwner\PropertyOwnerRepository;

class CreatePropertyOwnerController
{
	public function create($params)
	{
		try {
			$propertyOwnerRepository = new PropertyOwnerRepository();
			$service = new CreatePropertyOwnerService($propertyOwnerRepository);
			$propertyOwnerDto = new CreatePropertyOwnerDto((array) $params);
			$propertyOwner = $service->execute($propertyOwnerDto);
			return json_encode($propertyOwner);
		} catch (\Throwable $th) {
			return json_encode($th->getMessage());
		}
	}
}
