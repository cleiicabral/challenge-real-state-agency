<?php

namespace App\Services\PropertyOwner;

use App\Dtos\PropertyOwner\UpdatePropertyOwnerDto;
use App\Repositories\Interfaces\PropertyOwnerRepositoryInterface;

class UpdatePropertyOwnerService
{
	private $propertyOwnerRepositoryInterface;

	public function __construct(PropertyOwnerRepositoryInterface $propertyOwnerRepositoryInterface)
	{
		$this->propertyOwnerRepositoryInterface = $propertyOwnerRepositoryInterface;
	}

	public function execute(string $propertyOwnerId, UpdatePropertyOwnerDto $propertyOwnerDto)
	{
		$propertyOwner = $this->propertyOwnerRepositoryInterface->update($propertyOwnerId, $propertyOwnerDto);
		return $propertyOwner;
	}

}
