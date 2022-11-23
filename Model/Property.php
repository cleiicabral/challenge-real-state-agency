<?php

namespace App\Model;

class Property
{

	private string $propertyAdress;
	private string $propertyId;

	/**
	 * Constructor
	 *
	 * @param string $propertyAdress
	 * @param string $propertyId
	 */
	public function __construct($propertyAdress,$propertyId)
	{
		$this->propertyAdress = $propertyAdress;
		$this->propertyId = $propertyId;
	}



}
