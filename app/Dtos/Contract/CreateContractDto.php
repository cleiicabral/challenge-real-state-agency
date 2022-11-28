<?php

namespace App\Dtos\Contract;

class CreateContractDto
{
	public string $property_id;
	public string $property_owner_id;
	public string $client_id;
	public string $startDate;
	public string $endDate;
	public float $administrationFee;
	public float $rentAmount;
	public float $condoPrice;
	public float $iptuPrice;

	public function __construct(array $data)
	{
		$this->property_id = !empty($data['property_id']) ? $data['property_id'] : '';
		$this->property_owner_id = !empty($data['property_owner_id']) ? $data['property_owner_id'] : '';
		$this->client_id = !empty($data['client_id']) ? $data['client_id'] : '';
		$this->startDate = !empty($data['start_date']) ? $data['start_date'] : '';
		$this->endDate = !empty($data['end_date']) ? $data['end_date'] : '';
		$this->administrationFee = !empty($data['administration_fee']) ? $data['administration_fee'] : 0;
		$this->rentAmount = !empty($data['rent_amount']) ? $data['rent_amount'] : 0;
		$this->condoPrice = !empty($data['condo_price']) ? $data['condo_price'] : 0;
		$this->iptuPrice = !empty($data['iptu_price']) ? $data['iptu_price'] : 0;
	}
}
