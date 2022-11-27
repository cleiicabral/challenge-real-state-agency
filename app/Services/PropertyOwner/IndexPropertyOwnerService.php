<?php

namespace App\Services\PropertyOwner;

use App\Repositories\Interfaces\PropertyOwnerRepositoryInterface;

class IndexPropertyOwnerService
{
	private $propertyOwnerRepositoryInterface;

	public function __construct(PropertyOwnerRepositoryInterface $propertyOwnerRepositoryInterface)
	{
		$this->propertyOwnerRepositoryInterface = $propertyOwnerRepositoryInterface;
	}

	public function execute()
	{
		$propertyOwners = $this->propertyOwnerRepositoryInterface->index();
		return $propertyOwners;
	}

}
