<?php

namespace App\Dtos\MontlhyPayment;

class CreateMontlhyPaymentDto
{
	public float $price;
	public string $dueDate;
	public string $type;
	public string $status;
	public string $personInCharge;

	public function __construct(array $data)
	{
		$this->price = !empty($data['price']) ? $data['price'] : '';
		$this->dueDate = !empty($data['dueDate']) ? $data['dueDate'] : '';
		$this->type = !empty($data['type']) ? $data['type'] : '';
		$this->status = !empty($data['status']) ? $data['status'] : '';
		$this->personInCharge = !empty($data['personInCharge']) ? $data['personInCharge'] : '';
	}

}
