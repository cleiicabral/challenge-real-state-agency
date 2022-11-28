<?php

namespace App\Controllers\Client;

use App\Dtos\Client\UpdateClientDto;
use App\Services\Client\UpdateClientService;
use App\Repositories\Client\ClientRepository;

class UpdateClientController
{
	public function update($params)
	{
		try {
			$clientRepository = new ClientRepository();
			$service = new UpdateClientService($clientRepository);
			$clientDto = new UpdateClientDto((array) $params);
			$clients = $service->execute($params->id, $clientDto);
			return json_encode($clients);
		} catch (\Throwable $th) {
			return json_encode($th->getMessage());
		}
	}
}
