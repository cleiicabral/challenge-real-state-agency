<?php

namespace App\Controllers\Contract;

use App\Dtos\Contract\CreateContractDto;
use App\Repositories\Contract\ContractRepository;
use App\Repositories\MonthlyPayment\MonthlyPaymentRepository;
use App\Services\Contract\CreateContractService;

class CreateContractController
{

	public function create($params)
	{
		try {
			$contractRepository = new ContractRepository();
			$monthlyPayment = new MonthlyPaymentRepository();
			$createContractService = new CreateContractService($contractRepository,$monthlyPayment);
			$createContractDto = new CreateContractDto((array)$params);
			$contractCreated =  $createContractService->execute($createContractDto);
			return json_encode($contractCreated);
		} catch (\Throwable $th) {
			return json_encode($th->getMessage());
		}
	}
}
