<?php

namespace Src\models;

class Addresses
{
    private int     $addressId;
    private int     $userId;
    private string  $address;

    /**
     * @param ?int $addressId
     * @param int $userId
     * @param string $address
     */
    public function __construct(?int $addressId, int $userId, string $address)
    {
        if($addressId != null) {
            $this->addressId = $addressId;
        }
        $this->userId = $userId;
        $this->address = $address;
    }
    public function getAddressId(): int
    {
        return $this->addressId;
    }
    public function setAddressId(int $addressId): Addresses
    {
        $this->addressId = $addressId;
        return $this;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): Addresses
    {
        $this->userId = $userId;
        return $this;
    }
    public function getAddress(): string
    {
        return $this->address;
    }
    public function setAddress(string $address): Addresses
    {
        $this->address = $address;
        return $this;
    }




}
