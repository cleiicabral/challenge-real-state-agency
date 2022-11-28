<?php

namespace App\Services\Property;

use App\Dtos\Property\UpdatePropertyDto;
use App\Repositories\Interfaces\PropertyRepositoryInterface;
use App\Repositories\Property\PropertyRepository;

class UpdatePropertyService
{
	private PropertyRepositoryInterface $propertyRepositoryInterface;

	public function __construct(PropertyRepositoryInterface $propertyRepositoryInterface)
	{
		$this->propertyRepositoryInterface = $propertyRepositoryInterface;
	}

	public function update(string $propertyId, UpdatePropertyDto $updatePropertyDto)
	{
		$property = $this->propertyRepositoryInterface->update($propertyId, $updatePropertyDto);

		return $property;
	}
}
