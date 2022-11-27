<?php

declare(strict_types=1);

namespace App\Dtos\Client;

class CreateClientDto
{

    public string $name;
    public string $email;
    public string $phoneNumber;

	public function __construct(array $data)
	{
		$this->name = !empty($data['name']) ? $data['name'] : '';
		$this->email = !empty($data['email']) ? $data['email'] : '';
		$this->phoneNumber = !empty($data['phoneNumber']) ? $data['phoneNumber'] : '';
	}

	public function toArray()
    {
        return get_object_vars($this);
    }

}
