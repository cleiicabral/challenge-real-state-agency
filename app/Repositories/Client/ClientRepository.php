<?php

namespace App\Repositories\Client;

use PDO;

use Exception;
use Ramsey\Uuid\Uuid;
use App\database\connection;
use App\Dtos\Client\CreateClientDto;
use App\Dtos\Client\UpdateClientDto;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
	private $connection;

	public function __construct()
	{
		$this->connection = connection::getInstance();
	}
	public function create(CreateClientDto $clientDto)
	{
		try {
			$uuid = Uuid::uuid4();
			$insertQuery = 'INSERT INTO clients
				(id,name, email,phoneNumber,created_at,updated_at)
				VALUES (:id,:name, :email,:phoneNumber,:created_at,:updated_at);';
			$stmt = $this->connection->prepare($insertQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute([
				':id' => $uuid,
				':name' => $clientDto->name,
				':email' => $clientDto->email,
				':phoneNumber' => $clientDto->phoneNumber,
				':created_at' => date("Y-m-d H:i:s"),
				':updated_at' => date("Y-m-d H:i:s"),
			]);

			if($success){
				$clientCreated = $this->find($uuid);
			}

			return $success ? $clientCreated : null;
		} catch (Exception $e) {
			throw new Exception($e->getMessage(),400);
		}
	}

	public function index()
	{
		try {
			$sqlQuery = 'SELECT * FROM clients;';
	        $stmt = $this->connection->query($sqlQuery);
			$clientDataList = [];
			while($r = $stmt->fetchAll(PDO::FETCH_CLASS,'App\Model\Client')){
				$clientDataList[] = $r;
			}

			return $clientDataList;
		} catch (Exception $e) {
			throw new Exception($e->getMessage(),400);
		}

	}

	public function find(string $clientId)
	{
		try {
			$sqlQuery = 'SELECT * FROM clients WHERE id = ?;';
	        $stmt = $this->connection->prepare($sqlQuery);
	        $stmt->bindValue(1, $clientId);
	        $stmt->execute();
			$client = $stmt->fetchObject('App\Model\Client');

	        return $client;
		} catch (Exception $e) {
			throw new Exception($e->getMessage(),400);
		}
	}

	public function update(string $clientId, UpdateClientDto $clientDto)
	{
		try {
			$params = [];

			foreach ($clientDto as $key => $attribute) {
				if(!empty($attribute)){
					$params[] = "{$key} = '{$attribute}'";
				}
			}

			$params = implode(', ', $params);
			$updateQuery = "UPDATE clients SET {$params} WHERE id = '{$clientId}'";
			$stmt = $this->connection->prepare($updateQuery);
			var_dump($this->connection->errorInfo());

	        return $stmt->execute();

		} catch (Exception $e) {
			throw new Exception($e->getMessage(),400);
		}
	}

}
