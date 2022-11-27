<?php

namespace App\Repositories\Property;

use App\Model\PropertyOwner;
use PDO;
use Exception;
use Ramsey\Uuid\Uuid;
use App\database\connection;
use App\Dtos\Property\CreatePropertyDto;
use App\Dtos\Property\UpdatePropertyDto;
use App\Repositories\Interfaces\PropertyRepositoryInterface;

class PropertyRepository implements PropertyRepositoryInterface
{
	private $connection;
	private $table = 'properties';

	public function __construct()
	{
		$this->connection = connection::getInstance();
	}

	public function create(CreatePropertyDto $createPropertyDto)
	{
		try {
			$uuid = Uuid::uuid4();

			$insertQuery = "INSERT INTO  {$this->table}
				(id, property_address, property_owners_id, created_at, updated_at)
				VALUES (:id, :property_address, :property_owners_id, :created_at, :updated_at);";

			$stmt = $this->connection->prepare($insertQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute([
				':id' => $uuid,
				':property_address' => $createPropertyDto->propertyAddress,
				':property_owners_id' => $createPropertyDto->propertyOwnerId,
				':created_at' => date("Y-m-d H:i:s"),
				':updated_at' => date("Y-m-d H:i:s"),
			]);

			if($success){
				$propertyCreated = $this->findWithPropertyOwner($uuid);
			}

			return $success ? $propertyCreated : null;
		} catch (Exception $th) {
			throw new Exception($this->connection->errorInfo()[2],400);
		}
	}

	public function index()
	{
		try {
			$selectQuery = "SELECT
			{$this->table}.id,
			{$this->table}.property_address,
			{$this->table}.property_owners_id,
			{$this->table}.created_at,
			{$this->table}.updated_at,
			property_owners.id as property_owner_id,
			property_owners.name as property_owner_name,
			property_owners.email as property_owner_email,
			property_owners.phone_number as property_owner_phone_number,
			property_owners.payday as property_owner_payday,
			property_owners.created_at as property_owner_created_at,
			property_owners.updated_at as property_owner_updated_at
			FROM {$this->table} JOIN property_owners
			ON {$this->table}.property_owners_id = property_owners.id;";
			$stmt = $this->connection->prepare($selectQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute();

			$propertyDataList = [];

			if($success){
				$result = $stmt->fetchAll(PDO::FETCH_CLASS,'App\Model\Property');
				foreach ($result as $key => $row) {
					$propertyDataList[] = $row;
					$propertyOnwer = new PropertyOwner(
						$row->property_owner_name,
						$row->property_owner_email,
						$row->property_owner_phone_number,
						$row->property_owner_payday,
						$row->property_owner_created_at,
						$row->property_owner_updated_at,
					);
					$propertyDataList[$key]->setPropertyOwnerAttribute($propertyOnwer);
				}
			}

			return $success ? $propertyDataList : null;
		} catch (Exception $th) {
			throw new Exception($this->connection->errorInfo()[2],400);
		}
	}

	public function update(string $propertyId, UpdatePropertyDto $updatePropertyDto)
	{
		try {
			$updateQuery = "UPDATE {$this->table} SET
				property_adress = :property_adress,
				property_owner_id = :property_owner_id,
				updated_at = :updated_at
				WHERE id = :id";
			$stmt = $this->connection->prepare($updateQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute([
				':id' => $propertyId,
				':property_adress' => $updatePropertyDto->propertyAdress,
				':property_owner_id' => $updatePropertyDto->propertyOwnerId,
				':updated_at' => date("Y-m-d H:i:s"),
			]);

			if($success){
				$propertyUpdated = $this->findWithPropertyOwner($propertyId);
			}

			return $success ? $propertyUpdated : null;
		} catch (Exception $th) {
			throw new Exception($this->connection->errorInfo()[2],400);
		}
	}

	public function findWithPropertyOwner(string $propertyId)
	{
		try {
			$selectQuery = "SELECT
				{$this->table}.id,
				{$this->table}.property_address,
				{$this->table}.property_owners_id,
				{$this->table}.created_at,
				{$this->table}.updated_at,
				property_owners.id as property_owner_id,
				property_owners.name as property_owner_name,
				property_owners.email as property_owner_email,
				property_owners.phone_number as property_owner_phone_number,
				property_owners.payday as property_owner_payday,
				property_owners.created_at as property_owner_created_at,
				property_owners.updated_at as property_owner_updated_at
				FROM {$this->table} JOIN property_owners
				ON {$this->table}.property_owners_id = property_owners.id
				WHERE {$this->table}.id = :id;";
			$stmt = $this->connection->prepare($selectQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute([
				':id' => $propertyId,
			]);

			$propertyData = null;
			$propertyOwnerRelationship = new PropertyOwner();

			if($success){
				$propertyData = $stmt->fetchObject('App\Model\Property');
				$propertyOwnerRelationship->name = $propertyData->property_owner_name;
				$propertyOwnerRelationship->email = $propertyData->property_owner_email;
				$propertyOwnerRelationship->phoneNumber = $propertyData->property_owner_phone_number;
				$propertyOwnerRelationship->payday = $propertyData->property_owner_payday;
				$propertyOwnerRelationship->createdAt = $propertyData->property_owner_created_at;
				$propertyOwnerRelationship->updatedAt = $propertyData->property_owner_updated_at;

				$propertyData->setPropertyOwnerAttribute($propertyOwnerRelationship);
			}

			return $success ? $propertyData : null;
		} catch (Exception $th) {
			throw new Exception($this->connection->errorInfo()[2],400);
		}
	}
}
