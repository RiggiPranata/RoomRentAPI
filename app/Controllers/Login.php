<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\Model_login;

class Login extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->model = new Model_login();
    }

    public function index()
    {
        $validation = \Config\Services::validation();
        $aturan = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Silakan masukan email',
                    'valid_email' => 'Silakan masukan email yang valid'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silakan masukan password'
                ]
            ],
        ];
        $validation->setRule($aturan);
        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
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