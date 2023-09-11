<?php

namespace Src\models\DTO;

class UserCreateDTO
{
    private string $username;
    private string $password;
    private string $confirmPassword;
    private string $fullName;
    private string $phone;

    /**
     * @param string $username
     * @param string $password
     * @param string $confirmPassword
     * @param string $fullName
     * @param string $phone
     */
    public function __construct(string $username, string $password, string $confirmPassword, string $fullName, string $phone)
    {
        $this->username = $username;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->fullName = $fullName;
        $this->phone = $phone;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): UserCreateDTO
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): UserCreateDTO
    {
        $this->password = $password;
        return $this;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): UserCreateDTO
    {
        $this->confirmPassword = $confirmPassword;
        return $this;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): UserCreateDTO
    {
        $this->fullName = $fullName;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): UserCreateDTO
    {
        $this->phone = $phone;
        return $this;
    }
}