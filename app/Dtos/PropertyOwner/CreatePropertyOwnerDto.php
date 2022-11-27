<?php

declare(strict_types=1);

namespace App\Dtos\PropertyOwner;

class CreatePropertyOwnerDto
{
	public string $name;
	public string $email;
	public string $phoneNumber;
	public int $payday;

	/**
	 * Constructor function
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $phoneNumber
	 * @param integer $payday
	 */
	public function __construct(array $data)
	{
		$this->name = !empty($data['name']) ? $data['name'] : '';
		$this->email = !empty($data['email']) ? $data['email'] : '';
		$this->phoneNumber = !empty($data['phone_number']) ? $data['phone_number'] : '';
		$this->payday = !empty($data['payday']) ? (int) ($data['payday']) : 0;
	}

	public function toArray()
    {
        return get_object_vars($this);
    }
}
