<?php

namespace App\Controllers\PropertyOwner;

use App\Services\PropertyOwner\IndexPropertyOwnerService;
use App\Repositories\PropertyOwner\PropertyOwnerRepository;

class IndexPropertyOwnerController
{
	public function index()
	{
		try {
			$propertyOwnerRepository = new PropertyOwnerRepository();
			$service = new IndexPropertyOwnerService($propertyOwnerRepository);
			$propertyOwners = $service->execute();
			return json_encode($propertyOwners);
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}
}
