<?php

namespace App\Services\Contract;

use App\Dtos\Contract\UpdateContractDto;
use App\Repositories\Interfaces\ContractRepositoryInterface;

class UpdateContractService
{
	private ContractRepositoryInterface $contractRepositoryInterface;

	public function __construct(ContractRepositoryInterface $contractRepositoryInterface)
	{
		$this->contractRepositoryInterface = $contractRepositoryInterface;
	}

	public function execute(string $contractId, UpdateContractDto $updateContractDto)
	{
		return $this->contractRepositoryInterface->update($contractId, $updateContractDto);
	}
}
