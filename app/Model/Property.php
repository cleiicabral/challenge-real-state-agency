<?php

namespace App\Model;

use App\Model\PropertyOwner;

class Property
{

	public string $id;
	public string $propertyAdress;
	public PropertyOwner $propertyOwner;
	public string $createdAt;
	public string $updatedAt;

	public function propertyAdressAttribute()
	{
		return $this->propertyAdress;
	}

	public function setPropertyOwnerAttribute(PropertyOwner $propertyOwner)
	{
		$this->propertyOwner = $propertyOwner;
	}

	/**
	 * @return PropertyOwner
	 */
	public function getPropertyOwnerRelationship()
	{
		return $this->propertyOwner;
	}

	public function getCreatedAtAttribute()
	{
		return $this->createdAt;
	}

	public function getUpdatedAtAttribute()
	{
		return $this->updatedAt;
	}

}
