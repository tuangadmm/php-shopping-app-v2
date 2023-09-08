<?php

namespace Src\models;

use Src\models\Roles;

class Users
{

    private int     $userId;
    private string  $username;
    private string  $password;
    private string  $fullName;
    private string  $phone;
    private Roles $role;

    public function __construct(?int $userId, $username, ?string $password, $fullName, ?string $phone, Roles $role)
    {
        if($userId != null) {
            $this->userId = $userId;
        }

        if($password != null) {
            $this->password = $password;
        }

        if($phone != null) {
            $this->phone = $phone;
        }

        $this->username = $username;
        $this->fullName = $fullName;
        $this->role = $role;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): Users
    {
        $this->userId = $userId;
        return $this;
    }
    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $username): Users
    {
        $this->username = $username;
        return $this;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): Users
    {
        $this->password = $password;
        return $this;
    }
    public function getFullName(): string
    {
        return $this->fullName;
    }
    public function setFullName(string $fullName): Users
    {
        $this->fullName = $fullName;
        return $this;
    }
    public function getPhone(): string
    {
        return $this->phone;
    }
    public function setPhone(string $phone): Users
    {
        $this->phone = $phone;
        return $this;
    }

    public function getRole(): Roles
    {
        return $this->role;
    }
    public function setRole(Roles $role): Users
    {
        $this->role = $role;
        return $this;
    }




}
