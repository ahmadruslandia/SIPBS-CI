<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'user_id';

    public function validasiUsername($username)
    {
        return $this->where('user_email', $username)->first();
    }

    public function validasiPassword($username, $password)
    {
        return $this->where([
            'user_email' => $username,
            'user_password' => md5($password)
        ])->first();
    }
}
