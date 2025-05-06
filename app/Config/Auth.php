<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Auth extends BaseConfig
{
    public $defaultUserGroup = 'staff';
    public $groups = [
        'admin' => 1,
        'manager' => 2,
        'staff' => 3,
    ];
}