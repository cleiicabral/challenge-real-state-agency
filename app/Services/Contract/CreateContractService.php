<?php

namespace App\Services\Contract;

use App\Dtos\Contract\CreateContractDto;
use App\Dtos\MontlhyPayment\CreateMontlhyPaymentDto;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\MonthlyPaymentRepositoryInterface;
use App\Services\MonthlyPayment\CreateMonthlyPaymentService;
use Carbon\CarbonImmutable;

class CreateContractService
{
	private ContractRepositoryInterface $contractRepositoryInterface;
	private MonthlyPaymentRepositoryInterface $monthlyPaymentRepositoryInterface;

	public function __construct(
		ContractRepositoryInterface $contractRepositoryInterface
		,MonthlyPaymentRepositoryInterface $monthlyPaymentRepositoryInterface
	) {
		$this->contractRepositoryInterface = $contractRepositoryInterface;
		$this->monthlyPaymentRepositoryInterface = $monthlyPaymentRepositoryInterface;
	}

	public function execute(CreateContractDto $createContractDto)
	{
		$iptuPriceMonthly = $createContractDto->iptuPrice / 12;
		$administrationFeeMonthly = $createContractDto->administrationFee;
		$condoPriceMonthly = $createContractDto->condoPrice / 12;
		$rentValue = $createContractDto->rentAmount;
		$totalRentAmount = $iptuPriceMonthly + $condoPriceMonthly + $rentValue;
		$partialTransferAmount = ($totalRentAmount - $condoPriceMonthly);
		$transferAmountSubAdministrationFee = $partialTransferAmount - ($partialTransferAmount * ($administrationFeeMonthly/100));

		$dateAndHourNow = CarbonImmutable::now('America/Sao_paulo');
		$startOfMonth = $dateAndHourNow->firstOfMonth();
		$diffInDays = $dateAndHourNow->diffInDays($startOfMonth);

		if($diffInDays > 0) {
			$rentValueOfFirstMonth = $totalRentAmount - ($totalRentAmount * ($diffInDays / 30));
			$partialTransferAmountFirstMonth = $rentValueOfFirstMonth - ($condoPriceMonthly * ($diffInDays / 30));
			$transferAmountSubAdministrationFeeFirstMonth = $partialTransferAmountFirstMonth - ($partialTransferAmountFirstMonth * ($administrationFeeMonthly/100));
		}

		$createServiceMonthlyPayment = new CreateMonthlyPaymentService($this->monthlyPaymentRepositoryInterface);


		for ($i=0; $i < 12 ; $i++) {
			$startOfMonth = $startOfMonth->addMonth();
			if($i == 0) {
				$createMontlhyPaymentPropertyOwnerDto = new CreateMontlhyPaymentDto([
					"price" => $transferAmountSubAdministrationFeeFirstMonth,
					"dueDate" => $startOfMonth,
					"type" => "transfer",
					"status" => "pending",
					"personInCharge" => "propertyOwner",
					]
				);
				$createMonthlyPaymentTenantDto = new CreateMontlhyPaymentDto([
					"price" => $rentValueOfFirstMonth,
					"dueDate" => $startOfMonth,
					"type" => "rent",
					"status" => "pending",
					"personInCharge" => "tenant"
				]);

				$createServiceMonthlyPayment->execute($createMontlhyPaymentPropertyOwnerDto);
				$createServiceMonthlyPayment->execute($createMonthlyPaymentTenantDto);
			}else{
				$createMontlhyPaymentPropertyOwnerDto = new CreateMontlhyPaymentDto([
					"price" => $transferAmountSubAdministrationFee,
					"dueDate" => $startOfMonth,
					"type" => "transfer",
					"status" => "pending",
					"personInCharge" => "propertyOwner",
					]
				);
				$createMonthlyPaymentDto = new CreateMontlhyPaymentDto([
					"price" => $totalRentAmount,
					"dueDate" => $startOfMonth,
					"type" => "rent",
					"status" => "pending",
					"personInCharge" => "tenant"
				]);
				$createServiceMonthlyPayment->execute($createMontlhyPaymentPropertyOwnerDto);
				$createServiceMonthlyPayment->execute($createMonthlyPaymentDto);
			}
		}


		return $this->contractRepositoryInterface->create($createContractDto);
	}
}
