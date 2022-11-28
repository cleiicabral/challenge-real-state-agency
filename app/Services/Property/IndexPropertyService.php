<?php

namespace App\Services\Property;

use App\Repositories\Interfaces\PropertyRepositoryInterface;

class IndexPropertyService
{
	private PropertyRepositoryInterface $propertyRepositoryInterface;

	public function __construct(PropertyRepositoryInterface $propertyRepositoryInterface)
	{
		$this->propertyRepositoryInterface = $propertyRepositoryInterface;
	}

	public function index()
	{
		$properties = $this->propertyRepositoryInterface->index();

		return $properties;
	}
}
