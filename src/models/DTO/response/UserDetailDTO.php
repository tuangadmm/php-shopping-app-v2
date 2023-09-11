<?php

namespace Src\models\response;

class UserDetailDTO
{
    private int $userId;
    private string $username;
    private string $fullName;
    private string $phone;
    private string $role;
    private array $addresses;

    /**
     * @param int $userId
     * @param string $username
     * @param string $fullName
     * @param string $phone
     * @param string $role
     * @param array $addresses
     */
    public function __construct(int $userId, string $username, string $fullName, string $phone, string $role, array $addresses)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->fullName = $fullName;
        $this->phone = $phone;
        $this->role = $role;
        $this->addresses = $addresses;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): UserDetailDTO
    {
        $this->userId = $userId;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): UserDetailDTO
    {
        $this->username = $username;
        return $this;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): UserDetailDTO
    {
        $this->fullName = $fullName;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): UserDetailDTO
    {
        $this->phone = $phone;
        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): UserDetailDTO
    {
        $this->role = $role;
        return $this;
    }

    public function getAddresses(): array
    {
        return $this->addresses;
    }

    public function setAddresses(array $addresses): UserDetailDTO
    {
        $this->addresses = $addresses;
        return $this;
    }




}