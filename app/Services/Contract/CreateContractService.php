<?php

namespace App\Services\Contract;

use App\Dtos\Contract\CreateContractDto;
use App\Repositories\Interfaces\ContractRepositoryInterface;

class CreateContractService
{
	private ContractRepositoryInterface $contractRepositoryInterface;

	public function __construct(ContractRepositoryInterface $contractRepositoryInterface)
	{
		$this->contractRepositoryInterface = $contractRepositoryInterface;
	}

	public function execute(CreateContractDto $createContractDto)
	{
		return $this->contractRepositoryInterface->create($createContractDto);
	}
}
