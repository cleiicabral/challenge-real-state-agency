<?php

namespace App\Dtos\Contract;

class UpdateContractDto
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
		$this->startDate = !empty($data['startDate']) ? $data['startDate'] : '';
		$this->endDate = !empty($data['endDate']) ? $data['endDate'] : '';
		$this->administrationFee = !empty($data['administrationFee']) ? $data['administrationFee'] : 0;
		$this->rentAmount = !empty($data['rentAmount']) ? $data['rentAmount'] : 0;
		$this->condoPrice = !empty($data['condoPrice']) ? $data['condoPrice'] : 0;
		$this->iptuPrice = !empty($data['iptuPrice']) ? $data['iptuPrice'] : 0;
	}
}
