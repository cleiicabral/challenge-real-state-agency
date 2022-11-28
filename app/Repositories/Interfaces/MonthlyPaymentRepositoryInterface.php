<?php

namespace App\Repositories\Interfaces;
use App\Dtos\MontlhyPayment\CreateMontlhyPaymentDto;

interface MonthlyPaymentRepositoryInterface
{
	public function create(CreateMontlhyPaymentDto $createMontlhyPaymentDto);
	public function find(string $id);
	public function index();
}
