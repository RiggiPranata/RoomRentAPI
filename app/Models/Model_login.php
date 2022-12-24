<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Model_login extends Model
{

    protected $table = "authentication";
    protected $primaryKey = "id";
    protected $allowedFields = ['email', 'password'];


    function getEmail($email)
    {
        $builder = $this->table('authentication');
        $data = $builder->where('email', $email)->first();
        if (!$data) {
            throw new Exception("Data otetikasi tidak ditemukan");
        }
        return $data;
    }

    // protected $validationRules = [
    //     //field apa saja yang perlu divalidasi
    //     'email' => 'required|valid_email',
    //     'password' => 'required|min_length[6]'

    // ];

    // protected $validationMessages = [
    //     //pesan jika rule validation tidak terpenuhi
    //     'user_email' => [
    //         'required' => 'Email harus diisi',
    //         'valid_email' => 'Masukan E-mail yang valid'
    //     ],
    //     'password' => [
    //         'required' => 'Password harus diisi',
    //         'min_length' => 'Password harus lebih dari 6 character'
    //     ]
    // ];
}
