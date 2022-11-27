<?php

namespace App\Services\Contract;

use App\Repositories\Interfaces\ContractRepositoryInterface;

class IndexContractService
{
	private ContractRepositoryInterface $contractRepositoryInterface;

	public function __construct(ContractRepositoryInterface $contractRepositoryInterface)
	{
		$this->contractRepositoryInterface = $contractRepositoryInterface;
	}

	public function execute()
	{
		return $this->contractRepositoryInterface->index();
	}
}
