<?php

namespace App\Services\Client;

use App\Repositories\Interfaces\ClientRepositoryInterface;

class IndexClientService
{
	private $clientRepositoryInterface;
	public function __construct(ClientRepositoryInterface $clientRepositoryInterface)
	{
		$this->clientRepositoryInterface = $clientRepositoryInterface;
	}

	public function execute()
	{
		$result = $this->clientRepositoryInterface->index();
		return $result;
	}
}
