<?php

namespace App\Repositories\Interfaces;

use App\Dtos\Property\CreatePropertyDto;
use App\Dtos\Property\UpdatePropertyDto;

interface PropertyRepositoryInterface
{
	public function create(CreatePropertyDto $createPropertyDto);
	public function index();
	public function update(string $propertyId, UpdatePropertyDto $updatePropertyDto);
	public function findWithPropertyOwner(string $propertyId);
}
