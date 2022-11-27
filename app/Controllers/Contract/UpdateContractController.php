<?php

namespace App\Controllers\Contract;

use App\Dtos\Contract\UpdateContractDto;
use App\Services\Contract\UpdateContractService;
use App\Repositories\Contract\ContractRepository;

class UpdateContractController
{
	public function update($params)
	{
		try {
			$contractRepository = new ContractRepository();
			$updateContractService = new UpdateContractService($contractRepository);
			$updateContractDto = new UpdateContractDto($params);
			$contractUpdated =  $updateContractService->execute($params->id, $updateContractDto);
			return json_encode($contractUpdated);
		} catch (\Throwable $th) {
			return json_encode($th->getMessage());
		}
	}
}
