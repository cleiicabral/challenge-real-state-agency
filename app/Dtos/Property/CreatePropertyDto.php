<?php
declare(strict_types=1);

namespace App\Dtos\Property;

class CreatePropertyDto
{
	public string $propertyAddress;
	public string $propertyOwnerId;

	public function __construct(array $data)
	{
		$this->propertyAddress = !empty($data['property_adress']) ? $data['property_adress'] : '';
		$this->propertyOwnerId = !empty($data['property_owner_id']) ? $data['property_owner_id'] : '';
	}
}
