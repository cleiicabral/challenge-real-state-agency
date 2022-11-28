<?php

namespace App\Repositories\Interfaces;

use App\Dtos\Contract\CreateContractDto;
use App\Dtos\Contract\UpdateContractDto;

interface ContractRepositoryInterface
{
	public function create(CreateContractDto $createContractDto);
	public function update(string $contractId, UpdateContractDto $updateContractDto);
	public function findWithRelations(string $contractId);
	public function index();
}
