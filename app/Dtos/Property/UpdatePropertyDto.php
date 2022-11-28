<?php
declare(strict_types=1);

namespace App\Dtos\Property;

class UpdatePropertyDto
{
	public string $propertyAdress;
	public string $propertyOwnerId;

	public function __construct(array $data)
	{
		$this->propertyAdress = !empty($data['property_adress']) ? $data['property_adress'] : '';
		$this->propertyOwnerId = !empty($data['property_owner_id']) ? $data['property_owner_id'] : '';
	}
}
