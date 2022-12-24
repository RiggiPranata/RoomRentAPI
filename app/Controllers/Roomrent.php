<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\Model_roomrent;


class Roomrent extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->model = new Model_roomrent();
    }

    public function index()
    {
        //READ menampilkan data berdasarkan column dan sort(ASC,DESC)
        $data = $this->model->orderBy('ruangan_id', 'ASC')->findAll();
        return $this->respond($data, 200);
    }


    public function show($userId = null, $roomId = null)
    {

        //Mencari data berdasarkan ID bisa juga dengan nama
        $data = $this->model->where('user_id', $userId |  'room_id', $roomId)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk ID $userId atau Nama $roomId");
        }
    }

    public function create()
    {
        // $data = [
        //     //data yang diperlukan untuk meminjam ruangan

        // ];

        $data = $this->request->getPost();

        // $this->model->save($data);

        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }

        $responses = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Berhasil Meminjam Ruangan'
            ]
        ];
        return $this->respond($responses);
    }
}
