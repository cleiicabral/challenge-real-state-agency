<?php
namespace App\Controllers\Client;

use App\Dtos\Client\CreateClientDto;
use App\Repositories\Client\ClientRepository;
use App\Services\Client\CreateClientService;

class CreateClientController
{
	public function create($params)
	{

		try {
$this->file();
			$clientRepository = new ClientRepository();
			$service = new CreateClientService($clientRepository);
			$clientDto = new CreateClientDto( (array) $params);
			$clientCreated = $service->execute($clientDto);
			return json_encode($clientCreated);
		} catch (\Throwable $th) {
			return json_encode($th->getMessage());
		}

	}
}
