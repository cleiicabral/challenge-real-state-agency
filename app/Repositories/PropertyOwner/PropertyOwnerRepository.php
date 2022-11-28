<?php

namespace App\Repositories\PropertyOwner;

use PDO;
use Exception;
use Ramsey\Uuid\Uuid;
use App\database\connection;
use App\Dtos\PropertyOwner\CreatePropertyOwnerDto;
use App\Dtos\PropertyOwner\UpdatePropertyOwnerDto;
use App\Repositories\Interfaces\PropertyOwnerRepositoryInterface;

class PropertyOwnerRepository implements PropertyOwnerRepositoryInterface
{
	private $connection;
	private $table ='property_owners';

	public function __construct()
	{
		$this->connection = connection::getInstance();
	}

	public function create(CreatePropertyOwnerDto $propertyOwnerDto)
	{
		try {
			$uuid = Uuid::uuid4();
			$insertQuery = "INSERT INTO  {$this->table}
				(id,name, email, phone_number, payday, created_at, updated_at)
				VALUES (:id,:name, :email,:phone_number,:payday,:created_at,:updated_at);";
			$stmt = $this->connection->prepare($insertQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute([
				':id' => $uuid,
				':name' => $propertyOwnerDto->name,
				':email' => $propertyOwnerDto->email,
				':phone_number' => $propertyOwnerDto->phoneNumber,
				':payday' => $propertyOwnerDto->payday,
				':created_at' => date("Y-m-d H:i:s"),
				':updated_at' => date("Y-m-d H:i:s"),
			]);

			if($success){
				$propertyOwnerCreated = $this->find($uuid);
			}

			return $success ? $propertyOwnerCreated : null;
		} catch (Exception $e) {
			throw new Exception($e->getMessage(),400);
		}
	}

	public function index()
	{
		try {
			$sqlQuery = "SELECT * FROM {$this->table};";
	        $stmt = $this->connection->query($sqlQuery);
			$propertyOwnerDataList = [];
			while($r = $stmt->fetchAll(PDO::FETCH_CLASS,'App\Model\PropertyOwner')){
				$propertyOwnerDataList[] = $r;
			}

			return $propertyOwnerDataList;
		} catch (Exception $e) {
			throw new Exception($e->getMessage(),400);
		}
	}

	public function find(string $propertyOwnerId)
	{
		try {
			$sqlQuery = "SELECT * FROM {$this->table} WHERE id = ?;";
			$stmt = $this->connection->prepare($sqlQuery);
			$stmt->bindValue(1, $propertyOwnerId);
			$stmt->execute();
			$propertyOwner = $stmt->fetchObject('App\Model\PropertyOwner');

			return $propertyOwner;
		} catch (Exception $e) {
			throw new Exception($e->getMessage(),400);
		}
	}

	public function update(string $propertyOwnerId, UpdatePropertyOwnerDto $propertyOwnerDto)
	{
		try {
			$updateQuery = "UPDATE {$this->table} SET
				name = :name,
				email = :email,
				phoneNumber = :phoneNumber,
				payday = :payday,
				updated_at = :updated_at
				WHERE id = :id;";
			$stmt = $this->connection->prepare($updateQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute([
				':id' => $propertyOwnerId,
				':name' => $propertyOwnerDto->name,
				':email' => $propertyOwnerDto->email,
				':phoneNumber' => $propertyOwnerDto->phoneNumber,
				':payday' => $propertyOwnerDto->payday,
				':updated_at' => date("Y-m-d H:i:s"),
			]);

			if($success){
				$propertyOwnerUpdated = $this->find($propertyOwnerId);
			}

			return $success ? $propertyOwnerUpdated : null;
		} catch (Exception $e) {
			throw new Exception($e->getMessage(),400);
		}
	}
}
