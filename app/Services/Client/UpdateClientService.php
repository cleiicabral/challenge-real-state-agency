<?php

namespace App\Services\Client;


use Exception;
use App\Dtos\Client\UpdateClientDto;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class UpdateClientService
{

	private $clientRepositoryInterface;
	public function __construct(ClientRepositoryInterface $clientRepositoryInterface)
	{
		$this->clientRepositoryInterface = $clientRepositoryInterface;
	}

	public function execute(string $clientId,UpdateClientDto $clientDto)
	{

		$result = $this->clientRepositoryInterface->update($clientId,$clientDto);

		if(!$result){
			throw new Exception("Client not found", 400);
		}

		return $result;

	}
}
