<?php

namespace App\DTO;

class OrderCreateDTO
{
    public function __construct(
        private string $name,
        private string $phone,
        private string $comment,
        private string $address,
    ){
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}
