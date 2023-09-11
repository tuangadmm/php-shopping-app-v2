<?php

namespace Src\utils;

class Validator
{
    public static function formatString($str): string
    {
        return htmlspecialchars(stripslashes(trim($str)));
    }

    public static function formatName($name): string
    {
        return str_replace('/\s+/', ' ', trim($name));
    }

    public static function isNameValid(string $name): bool
    {
        if(strlen($name) < 3) {
            return false;
        }
        $pattern = "/^[A-Za-z\s]{2,100}$/";
        return preg_match($pattern, $name);
    }

    public static function isPhoneValid(string $phone): bool
    {
        if(strlen($phone) < 10) {
            return false;
        }

        $pattern = "/^0[1-9][0-9]{0,18}$/";
        return preg_match($pattern, $phone);
    }

    public static function isUsernameValid(string $username): bool
    {
        $pattern = "/^[a-zA-Z][0-9a-zA-Z]{0,28}$/";
        return preg_match($pattern, $username);
    }

    public static function isPasswordsMatch(string $password, string $confirmPassword): bool
    {
        return $password === $confirmPassword;
    }

}
