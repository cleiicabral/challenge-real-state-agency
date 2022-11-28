<?php

namespace App\Repositories\Interfaces;

use App\Dtos\PropertyOwner\CreatePropertyOwnerDto;
use App\Dtos\PropertyOwner\UpdatePropertyOwnerDto;

interface PropertyOwnerRepositoryInterface
{
	public function create(CreatePropertyOwnerDto $propertyOwnerDto);
	public function index();
	public function find(string $propertyOwnerId);
	public function update(string $propertyOwnerId, UpdatePropertyOwnerDto $propertyOwnerDto);
}
