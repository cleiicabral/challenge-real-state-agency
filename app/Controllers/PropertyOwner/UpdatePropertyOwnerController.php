<?php

namespace App\Controllers\PropertyOwner;

use App\Dtos\PropertyOwner\UpdatePropertyOwnerDto;
use App\Services\PropertyOwner\UpdatePropertyOwnerService;
use App\Repositories\PropertyOwner\PropertyOwnerRepository;

class UpdatePropertyOwnerController
{
	public function update($params)
	{
		try {
			$propertyOwnerRepository = new PropertyOwnerRepository();
			$service = new UpdatePropertyOwnerService($propertyOwnerRepository);
			$propertyOwnerDto = new UpdatePropertyOwnerDto((array) $params);
			$propertyOwner = $service->execute($params->id, $propertyOwnerDto);
		} catch (\Throwable $th) {
			return $th->getMessage();
		}

	}
}
