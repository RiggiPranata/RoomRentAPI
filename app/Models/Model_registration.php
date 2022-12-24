<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_registration extends Model
{

    protected $table = "users";
    protected $primaryKey = "user_id";
    protected $allowedFields = ['user_name', 'user_email', 'password', 'no_telepon', 'user_kelas', 'user_semester', 'user_jurusan'];


    protected $validationRules = [
        //field apa saja yang perlu divalidasi
        'user_name' => 'required|alpha_space',
        'user_email' => 'required|valid_email',
        'password' => 'required|min_length[6]',
        'no_telepon' => 'required|numeric',
        'user_kelas' => 'required|alpha_space',
        'user_semester' => 'required|numeric',
        'user_jurusan' => 'required|alpha_space'

    ];

    protected $validationMessages = [
        //pesan jika rule validation tidak terpenuhi
        'user_name' => [
            'required' => 'Nama harus diisi',
            'alpha_space' => 'Nama tidak boleh mengandung angka atau simbol'
        ],
        'user_email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Masukan E-mail yang valid'
        ],
        'password' => [
            'required' => 'Password harus diisi',
            'min_length' => 'Password harus lebih dari 6 character'
        ],
        'no_telepon' => [
            'required' => 'No Telepon harus diisi',
            'numeric' => 'No telepon harus berupa angka'
        ],
        'user_kelas' => [
            'required' => 'Kelas harus diisi',
            'alpha_space' => 'Kelas hanya boleh mengandung huruf, angka dan spasi'
        ],
        'user_semester' => [
            'required' => 'Semester harus diisi',
            'numeric' => 'Semester harus berupa angka'
        ],
        'user_jurusan' => [
            'required' => 'Jurusan harus diisi',
            'alpha_space' => 'Jurusan hanya boleh mengandung huruf dan spasi'
        ],
    ];
}
