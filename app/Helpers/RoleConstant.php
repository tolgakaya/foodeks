<?php

namespace App\Helpers;

class RoleConstant
{
    public  const ROLE_ADMIN = 1;
    public const ROLE_CUSTOMER = 2;
    public const ROLE_MANAGER = 3;
    public const ROLE_CARRIER = 4;

    public static function UserRole($role)
    {
        if ($role === RoleConstant::ROLE_ADMIN) {
            return "Site Yöneticisi";
        } elseif ($role === RoleConstant::ROLE_CARRIER) {
            return 'Paketçi';
        } elseif ($role === RoleConstant::ROLE_CUSTOMER) {
            return 'Müşteri';
        } elseif ($role === RoleConstant::ROLE_MANAGER) {
            return 'Müdür';
        }
    }
    public static function Roles()
    {
        return [
            RoleConstant::ROLE_ADMIN => 'SüperYönetici',
            RoleConstant::ROLE_CARRIER => 'Paketçi',
            RoleConstant::ROLE_CUSTOMER => 'Müşteri',
            RoleConstant::ROLE_MANAGER => 'Müdür'
        ];
    }
}