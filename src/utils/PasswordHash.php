<?php

namespace Src\utils;

class PasswordHash
{

    public static function hashPassword($password): string
    {
        $pepper = '98GIUIiGyugBJyFAJkjKIiuhipjoo09';

        $pwd_peppered = hash_hmac("sha256", $password, $pepper);

        return password_hash($pwd_peppered, PASSWORD_ARGON2ID);
    }

    public static function verifyPassword($password, $hashedPassword) : bool
    {
        return password_verify($password, $hashedPassword);
    }

}