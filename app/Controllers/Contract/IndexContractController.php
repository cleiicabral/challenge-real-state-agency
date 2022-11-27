<?php

namespace App\Controllers\Contract;

use App\Services\Contract\IndexContractService;
use App\Repositories\Contract\ContractRepository;

class IndexContractController
{
	public function index()
	{
		try {
			$contractRepository = new ContractRepository();
			$indexContractsService = new IndexContractService($contractRepository);
			$contracts = $indexContractsService->execute();
			return json_encode($contracts);
		} catch (\Throwable $th) {
			return json_encode($th->getMessage());
		}
	}
}
