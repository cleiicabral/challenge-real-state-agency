<?php

namespace App\Services\Property;

use App\Dtos\Property\CreatePropertyDto;
use App\Repositories\Property\PropertyRepository;
use App\Repositories\Interfaces\PropertyRepositoryInterface;

class CreatePropertyService
{
	private PropertyRepositoryInterface $propertyRepositoryInterface;

	public function __construct(PropertyRepositoryInterface $propertyRepositoryInterface)
	{
		$this->propertyRepositoryInterface = $propertyRepositoryInterface;
	}

	public function create(CreatePropertyDto $createPropertyDto)
	{
		$property = $this->propertyRepositoryInterface->create($createPropertyDto);

		return $property;
	}
}
