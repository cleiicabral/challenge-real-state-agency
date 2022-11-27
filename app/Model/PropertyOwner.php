<?php

namespace app\Model;

class PropertyOwner
{

	public string $id;
    public string $name;
    public string $email;
    public string $phoneNumber;
    public int $payday;
    public string $createdAt;
    public string $updatedAt;

	/**
	 * Constructor function
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $phoneNumber
	 * @param int $payday
	 * @param string $createdAt
	 * @param string $updatedAt
	 *
	 */
    public function __construct(
		?string $name = '',
		?string $email = '',
		?string $phoneNumber = '',
		?int $payday = 0,
		?string $createdAt = '',
		?string $updatedAt = ''
	) {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->payday = $payday;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getNameAttribute()
	{
        return $this->name;
    }

    public function getEmailAttribute()
	{
        return $this->email;
    }

    public function getPhoneNumberAttribute()
	{
        return $this->phoneNumber;
    }

    public function getPaydayAttribute()
	{
        return $this->payday;
    }

	public function getCreatedAtAttribute()
	{
		return $this->createdAt;
	}

	public function getUpdatedAtAttribute()
	{
		return $this->updatedAt;
	}
}
