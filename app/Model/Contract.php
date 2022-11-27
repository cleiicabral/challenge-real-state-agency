<?php

namespace App\Model;

use app\Model\PropertyOwner;

class Contract
{
	public Property $property;
	public PropertyOwner $propertyOwner;
	public Client $client;
	public string $startDate;
	public string $endDate;
	public float $administrationFee;
	public float $rentAmount;
	public float $condoPrice;
	public float $iptuPrice;
	public string $created_at;
	public string $updated_at;

	public function getStartDateAttribute()
	{
		return $this->startDate;
	}

	public function getEndDateAttribute()
	{
		return $this->endDate;
	}

	public function getAdministrationFeeAttribute()
	{
		return $this->administrationFee;
	}

	public function getRentAmountAttribute()
	{
		return $this->rentAmount;
	}

	public function getCondoPriceAttribute()
	{
		return $this->condoPrice;
	}

	public function getIptuPriceAttribute()
	{
		return $this->iptuPrice;
	}

	public function setPropertyAttribute(Property $property)
	{
		$this->property = $property;
	}

	public function getPropertyRelationship()
	{
		return $this->property;
	}

	public function setPropertyOwnerAttribute(PropertyOwner $propertyOwner)
	{
		$this->propertyOwner = $propertyOwner;
	}

	public function getPropertyOwnerRelationship()
	{
		return $this->propertyOwner;
	}

	public function setClientAttribute(Client $client)
	{
		$this->client = $client;
	}

	public function getClientRelationship()
	{
		return $this->client;
	}

	public function getCreatedAtAttribute()
	{
		return $this->created_at;
	}

	public function getUpdatedAtAttribute()
	{
		return $this->updated_at;
	}

}
