<?php

namespace Src\models;

class Roles
{

    private int     $roleId;
    private string  $roleName;

    public function __construct(?int $roleId, string $roleName)
    {
        if($roleId != null) {
            $this->roleId = $roleId;
        }
        $this->roleName = $roleName;
    }
    public function getRoleId(): int
    {
        return $this->roleId;
    }
    public function setRoleId(int $roleId): Roles
    {
        $this->roleId = $roleId;
        return $this;
    }
    public function getRoleName(): string
    {
        return $this->roleName;
    }
    public function setRoleName(string $roleName): Roles
    {
        $this->roleName = $roleName;
        return $this;
    }




}
