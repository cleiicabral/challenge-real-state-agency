<?php

namespace App\Model;

use App\Model\Traits\TraitUuid;
use PhpDao\Model;

class Client
{
	public string $id;
    public string $name;
    public string $email;
    public string $phoneNumber;
    public string $createdAt;
    public string $updatedAt;

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

	public function getCreatedAtAttribute()
	{
		return $this->createdAt;
	}

	public function getUpdatedAtAttribute()
	{
		return $this->updatedAt;
	}

}
