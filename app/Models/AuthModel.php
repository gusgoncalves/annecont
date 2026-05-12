<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'username', 'email', 'password','firstname','phone','gender','ativo'
    ];

    public function login($username, $password)
    {
        $user = $this->where('username', $username)->first();
        if (!$user)
        {
            return false;
        }
        if(!password_verify($password, $user['password'])) 
        {
            return false;
        }    
        return $user;
    }
}
