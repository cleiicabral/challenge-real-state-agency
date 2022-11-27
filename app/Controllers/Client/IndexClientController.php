<?php
namespace App\Controllers\Client;

use App\database\CreatorDoctrine;
use App\Repositories\Client\ClientRepository;
use App\Services\Client\IndexClientService;


class IndexClientController
{
	public function index()
	{

			$entit = CreatorDoctrine::createEntityManager();
			var_dump($entit);
			$clientRepository = new ClientRepository();
			$service = new IndexClientService($clientRepository);
			$clients = $service->execute();
			return json_encode($clients);

	}
}
