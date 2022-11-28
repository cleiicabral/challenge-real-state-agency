<?php

namespace App\Services\PropertyOwner;

use App\Dtos\PropertyOwner\CreatePropertyOwnerDto;
use App\Repositories\Interfaces\PropertyOwnerRepositoryInterface;
use App\Repositories\PropertyOwner\PropertyOwnerRepository;

class CreatePropertyOwnerService
{
	private $propertyOwnerRepositoryInterface;

	public function __construct(PropertyOwnerRepositoryInterface $propertyOwnerRepositoryInterface)
	{
		$this->propertyOwnerRepositoryInterface = $propertyOwnerRepositoryInterface;
	}

	public function execute(CreatePropertyOwnerDto $propertyOwnerDto)
	{
		$propertyOwner = $this->propertyOwnerRepositoryInterface->create($propertyOwnerDto);

		return $propertyOwner;
	}
}
