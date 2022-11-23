<?php

namespace App\Model;

class Contract
{
	private string $propertyId;
	private string $propertyOwnerId;
	private string $clientId;
	private string $startDate;
	private string $endDate;
	private string $administrationFee;
	private float $rentAmount;
	private float $condoPrice;
	private float $iptuPrice;

	/**
	 * Constructor
	 *
	 * @param string $propertyId
	 * @param string $propertyOwnerId
	 * @param string $clientId
	 * @param string $startDate
	 * @param string $endDate
	 * @param float $administrationFee
	 * @param float $rentAmount
	 * @param float $condoPrice
	 * @param float $iptuPrice
	 *
	 */
	public function __construct(
		$propertyId,
		$propertyOwnerId,
		$clientId,
		$startDate,
		$endDate,
		$administrationFee,
		$rentAmount,
		$condoPrice,
		$iptuPrice
	)
	{
		$this->propertyId = $propertyId;
		$this->propertyOwnerId = $propertyOwnerId;
		$this->clientId = $clientId;
		$this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->administrationFee = $administrationFee;
		$this->rentAmount = $rentAmount;
		$this->condoPrice = $condoPrice;
		$this->iptuPrice = $iptuPrice;
	}

}
