<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\Model_registration;

class Registration extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->model = new Model_registration();
    }

    public function index()
    {
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

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Berhasil Membuat User'
            ]
        ];
        return $this->respond($response);
    }
}
