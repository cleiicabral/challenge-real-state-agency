<?php

namespace App\Services\Client;


use App\Dtos\Client\CreateClientDto;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class CreateClientService
{
	private $clientRepositoryInterface;
	public function __construct(ClientRepositoryInterface $clientRepositoryInterface)
	{
		$this->clientRepositoryInterface = $clientRepositoryInterface;
	}

	public function execute(CreateClientDto $clientDto)
	{
		$result = $this->clientRepositoryInterface->create($clientDto);
		return $result;

	}
}

