<?php

namespace App\Services\MonthlyPayment;

use App\Dtos\MontlhyPayment\CreateMontlhyPaymentDto;
use App\Repositories\Interfaces\MonthlyPaymentRepositoryInterface;

class CreateMonthlyPaymentService
{
	private MonthlyPaymentRepositoryInterface $monthlyPaymentRepository;

	public function __construct(MonthlyPaymentRepositoryInterface $monthlyPaymentRepository)
	{
		$this->monthlyPaymentRepository = $monthlyPaymentRepository;
	}

	public function execute(CreateMontlhyPaymentDto $createMontlhyPaymentDto)
	{

		$monthlyPayment = $this->monthlyPaymentRepository->create($createMontlhyPaymentDto);

		return $monthlyPayment;
	}
}
