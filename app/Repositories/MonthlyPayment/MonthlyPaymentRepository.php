<?php

namespace App\Repositories\MonthlyPayment;

use Exception;
use Ramsey\Uuid\Uuid;
use App\database\connection;
use App\Dtos\MontlhyPayment\CreateMontlhyPaymentDto;
use App\Repositories\Interfaces\MonthlyPaymentRepositoryInterface;

class MonthlyPaymentRepository implements MonthlyPaymentRepositoryInterface
{
	private $connection;
	private $table = 'monthly_payments';

	public function __construct()
	{
		$this->connection = connection::getInstance();
	}
	public function create(CreateMontlhyPaymentDto $createMontlhyPaymentDto)
	{
		try {
			$uuid = Uuid::uuid4();

			$insertQuery = "INSERT INTO  {$this->table}
				(id, price, due_date, type, status, person_in_charge, created_at, updated_at)
				VALUES (:id, :price, :due_date, :type, :status, :person_in_charge, :created_at, :updated_at);";

			$stmt = $this->connection->prepare($insertQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute([
				':id' => $uuid,
				':price' => $createMontlhyPaymentDto->price,
				':due_date' => $createMontlhyPaymentDto->dueDate,
				':type' => $createMontlhyPaymentDto->type,
				':status' => $createMontlhyPaymentDto->status,
				':person_in_charge' => $createMontlhyPaymentDto->personInCharge,
				':created_at' => date("Y-m-d H:i:s"),
				':updated_at' => date("Y-m-d H:i:s")
			]);

			if($success){
				$monthlyPaymentCreated = $this->find($uuid);
			}

			return $success ? $monthlyPaymentCreated : null;
		} catch (Exception $e) {
			throw new Exception($e->getMessage(),400);
		}
	}

	public function find(string $paymentId)
	{
		try {
			$selectQuery = "SELECT * FROM {$this->table} WHERE id = :id";

			$stmt = $this->connection->prepare($selectQuery);

			if(!$stmt){
				throw new Exception($this->connection->errorInfo()[2], 400);
			}

			$success = $stmt->execute([
				':id' => $paymentId
			]);

			if($success){
				$monthlyPayment = $stmt->fetchObject('App\Model\MonthlyPayment');
			}

			return $success ? $monthlyPayment : null;
		} catch (Exception $e) {
			throw new Exception($e->getMessage(),400);
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
				$monthlyPayments = $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\Model\MontlhyPayment');
			}

			return $success ? $monthlyPayments : null;
		} catch (Exception $e) {
			throw new Exception($e->getMessage(),400);
		}
	}
}
