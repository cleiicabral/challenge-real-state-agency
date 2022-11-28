<?php
namespace App\Controllers\Client;

use App\database\CreatorDoctrine;
use App\Repositories\Client\ClientRepository;
use App\Services\Client\IndexClientService;


class IndexClientController
{
	public function index()
	{
		try {
			$clientRepository = new ClientRepository();
			$service = new IndexClientService($clientRepository);
			$clients = $service->execute();
			return json_encode($clients);
		} catch (\Throwable $th) {
			return json_encode($th->getMessage());
		}
	}
}
