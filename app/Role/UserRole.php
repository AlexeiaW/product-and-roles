<?php

namespace App\Role;

/***
 * Class UserRole
 * @package App\Role
 */
class UserRole
{

    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUBMIT = 'ROLE_SUBMIT';
    const ROLE_APPROVE = 'ROLE_APPROVE';
    const ROLE_CLIENT = 'ROLE_CLIENT';


    /**
     * @var array
     */
    protected static $roleHierarchy = [
        self::ROLE_ADMIN => ['*'],
        self::ROLE_SUBMIT => [],
        self::ROLE_APPROVE => [],
        self::ROLE_CLIENT => []
    ];

    /**
     * @param string $role
     * @return array
     */
    public static function getAllowedRoles(string $role)
    {
        if (isset(self::$roleHierarchy[$role])) {
            return self::$roleHierarchy[$role];
        }

        return [];
    }

    /***
     * @return array
     */
    public static function getRoleList()
    {
        return [
            static::ROLE_ADMIN => 'ROLE_ADMIN',
            static::ROLE_SUBMIT => 'ROLE_SUBMIT',
            static::ROLE_APPROVE => 'ROLE_APPROVE',
            static::ROLE_CLIENT => 'ROLE_CLIENT'
        ];
    }
}
