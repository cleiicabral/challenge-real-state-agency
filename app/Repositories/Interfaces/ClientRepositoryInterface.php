<?php

namespace App\Repositories\Interfaces;


use App\Dtos\Client\CreateClientDto;
use App\Dtos\Client\UpdateClientDto;

interface ClientRepositoryInterface
{
	public function create(CreateClientDto $clientDto);
	public function index();
	public function find(string $clientId);
	public function update(string $clientId,UpdateClientDto $data);
}
