<?php

namespace App\Model;

class Client
{

    private string $name;
    private string $email;
    private string $phoneNumber;

    public function __construct($name,$email,$phoneNumber)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
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

}
