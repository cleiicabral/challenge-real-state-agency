<?php

namespace App\Repositories\Contract;
use Exception;
use App\Model\Client;
use Ramsey\Uuid\Uuid;
use App\Model\Property;
use App\database\connection;
use App\Model\PropertyOwner;
use App\Dtos\Contract\CreateContractDto;
use App\Dtos\Contract\UpdateContractDto;
use App\Model\Contract;
use App\Repositories\Interfaces\ContractRepositoryInterface;

class ContractRepository implements ContractRepositoryInterface
{
	private $connection;
	private $table = 'contracts';

	public function __construct()
	{
		$this->connection = connection::getInstance();
	}

	public function create(CreateContractDto $createContractDto)
	{
		try {
			$uuid = Uuid::uuid4();
			$insertQuery = "INSERT INTO  {$this->table}
				(id, properties_id, property_owners_id, clients_id, start_date, end_date, administration_fee, rent_amount, condo_price, iptu_price, created_at, updated_at)
				VALUES (
				:id,
				:properties_id,
				:property_owners_id,
				:clients_id,
				:start_date,
				:end_date,
				:administration_fee,
				:rent_amount,
				:condo_price,
				:iptu_price,
				:created_at,
				:updated_at);";

			$stmt = $this->connection->prepare($insertQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute([
				':id' => $uuid,
				':properties_id' => $createContractDto->property_id,
				':property_owners_id' => $createContractDto->property_owner_id,
				':clients_id' => $createContractDto->client_id,
				':start_date' => $createContractDto->startDate,
				':end_date' => $createContractDto->endDate,
				':administration_fee' => $createContractDto->administrationFee,
				':rent_amount' => $createContractDto->rentAmount,
				':condo_price' => $createContractDto->condoPrice,
				':iptu_price' => $createContractDto->iptuPrice,
				':created_at' => date("Y-m-d H:i:s"),
				':updated_at' => date("Y-m-d H:i:s"),
			]);

			if($success){
				$propertyCreated = $this->findWithRelations($uuid);
			}

			return $success ? $propertyCreated : null;
		} catch (Exception $th) {
			throw new Exception($th->getMessage(),400);
		}
	}

	public function index()
	{
		try {
			$selectQuery = "SELECT * FROM {$this->table}";
			$stmt = $this->connection->prepare($selectQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute();

			if($success){
				$contracts = $stmt->fetchAll();
			}

			return $success ? $contracts : null;
		} catch (Exception $th) {
			throw new Exception($th->getMessage(),400);
		}
	}

	public function update(string $contractId, UpdateContractDto $updateContractDto)
	{
		try {
			$updateQuery = "UPDATE {$this->table}
				SET
				property_id = :property_id,
				property_owner_id = :property_owner_id,
				client_id = :client_id,
				start_date = :start_date,
				end_date = :end_date,
				administration_fee = :administration_fee,
				rent_amount = :rent_amount,
				condo_price = :condo_price,
				iptu_price = :iptu_price,
				updated_at = :updated_at
				WHERE id = :id";
			$stmt = $this->connection->prepare($updateQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute([
				':id' => $contractId,
				':property_id' => $updateContractDto->property_id,
				':property_owner_id' => $updateContractDto->property_owner_id,
				':client_id' => $updateContractDto->client_id,
				':start_date' => $updateContractDto->startDate,
				':end_date' => $updateContractDto->endDate,
				':administration_fee' => $updateContractDto->administrationFee,
				':rent_amount' => $updateContractDto->rentAmount,
				':condo_price' => $updateContractDto->condoPrice,
				':iptu_price' => $updateContractDto->iptuPrice,
				':updated_at' => date("Y-m-d H:i:s"),
			]);

			if($success){
				$contractUpdated = $this->findWithRelations($contractId);
			}

			return $success ? $contractUpdated : null;
		} catch (Exception $th) {
			throw new Exception($this->connection->errorInfo()[2],400);
		}
	}

	public function findWithRelations(string $contractId)
	{
		try {
			$selectQuery = "SELECT
				contracts.id,
				contracts.properties_id,
				contracts.property_owners_id,
				contracts.clients_id,
				contracts.start_date,
				contracts.end_date,
				contracts.administration_fee,
				contracts.rent_amount,
				contracts.condo_price,
				contracts.iptu_price,
				contracts.created_at,
				contracts.updated_at,
				clients.name as client_name,
				clients.email as client_email,
				clients.phone_number as client_phone,
				clients.created_at as client_created_at,
				clients.updated_at as client_updated_at,
				property_owners.name as property_owner_name,
				property_owners.email as property_owner_email,
				property_owners.phone_number as property_owner_phone,
				property_owners.payday as property_owner_payday,
				property_owners.created_at as property_owner_created_at,
				property_owners.updated_at as property_owner_updated_at,
				properties.property_address as property_address,
				properties.property_owners_id as property_owner_id,
				properties.created_at as property_created_at,
				properties.updated_at as property_updated_at
				FROM {$this->table}
				INNER JOIN clients ON contracts.clients_id = clients.id
				INNER JOIN property_owners ON contracts.property_owners_id = property_owners.id
				INNER JOIN properties ON contracts.properties_id = properties.id
				WHERE contracts.id = :id";
			$stmt = $this->connection->prepare($selectQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute([
				':id' => $contractId
			]);

			$contractData = null;
			$clientRelationship = new Client();
			$propertyOwnerRelationship = new PropertyOwner();
			$propertyRelationship = new Property();

			if($success){
				$contractData = $stmt->fetchObject('App\Model\Contract');
				$clientRelationship->name = $contractData->client_name;
				$clientRelationship->email = $contractData->client_email;
				$clientRelationship->phoneNumber = $contractData->client_phone;
				$clientRelationship->createdAt = $contractData->client_created_at;
				$clientRelationship->updatedAt = $contractData->client_updated_at;
				$contractData->setClientAttribute($clientRelationship);

				$propertyOwnerRelationship->id = $contractData->property_owner_id;
				$propertyOwnerRelationship->name = $contractData->property_owner_name;
				$propertyOwnerRelationship->email = $contractData->property_owner_email;
				$propertyOwnerRelationship->phoneNumber = $contractData->property_owner_phone;
				$propertyOwnerRelationship->payday = $contractData->property_owner_payday;
				$propertyOwnerRelationship->createdAt = $contractData->property_owner_created_at;
				$propertyOwnerRelationship->updatedAt = $contractData->property_owner_updated_at;
				$contractData->setPropertyOwnerAttribute($propertyOwnerRelationship);

				$propertyRelationship->propertyAdress = $contractData->property_address;
				$propertyRelationship->createdAt = $contractData->created_at;
				$propertyRelationship->updatedAt = $contractData->updated_at;
				$contractData->setPropertyAttribute($propertyRelationship);

			}

			return $success ? $contractData : null;
		} catch (Exception $th) {
			throw new Exception($th->getMessage(),400);
		}
	}
}
