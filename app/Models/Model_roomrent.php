<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_roomrent extends Model
{

    protected $table = "rental";
    protected $forgeinKey = ['ruangan_id', 'user_id'];
    protected $allowFields = ['time_start', 'end_start', 'date', 'no_telepon', 'remark'];

    protected $validationRules = [
        //field apa saja yang perlu divalidasi
        'time_start' => 'required',
        'time_end' => 'required',
        'date' => 'required',
        'no_telepon' => 'required',

    ];

    protected $validationMessage = [
        //pesan jika rule validation tidak terpenuhi
        'time_start' => [
            'required' => 'Waktu awal peminjaman harus diisi'
        ],
        'time_end' => [
            'required' => 'Waktu akhir peminjaman harus diisi'
        ],
        'date' => [
            'required' => 'Tanggal peminjaman harus diisi'
        ],
        'no_telepon' => [
            'required' => 'No telepon peminjam harus diisi'
        ]
    ];
}
