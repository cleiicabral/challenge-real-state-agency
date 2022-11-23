<?php

namespace App\Model;

class PropertyOwner
{

    private string $name;
    private string $email;
    private string $phoneNumber;
    private int $payday;

    public function __construct($name,$email,$phoneNumber,$payday)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->payday = $payday;
    }

    /**
     * Method that returns the name attribute of the client object
     * @return string;
     */
    public function getNameAttribute() {
        return $this->name;
    }

    public function getEmailAttribute() {
        return $this->email;
    }

    public function getPhoneNumberAttribute() {
        return $this->phoneNumber;
    }

    public function getPaydayAttribute() {
        return $this->payday;
    }
}
