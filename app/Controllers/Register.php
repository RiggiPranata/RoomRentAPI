<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;


class Register extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        helper(['form']);
        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confpassword' => 'required|matches[password]',
            'nama' => 'required|alpha_space',
            'no_telepon' => 'required|numeric',
            'kelas' => 'required|alpha_numeric_space',
            'semester' => 'required|numeric',
            'jurusan' => 'required|alpha_numeric_space'
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $data = [
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'nama' => $this->request->getVar('nama'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'kelas' => $this->request->getVar('kelas'),
            'semester' => $this->request->getVar('semester'),
            'jurusan' => $this->request->getVar('jurusan'),
        ];
        $model = new UserModel();
        $model->save($data);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Registration Success'
            ]
        ];
        return $this->respondCreated($response);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        // $key = getenv('JWT_SECRET_KEY');
        // $header = $this->request->getServer('HTTP_AUTHORIZATION');
        // if (!$header) return $this->failUnauthorized("Token Required");
        // $token = explode(' ', $header)[1];

        // try {
        //     $decoded = JWT::decode($token, new Key($key, 'HS256'));
        //     $response = [
        //         'id' => $decoded->uid,
        //         'email' => $decoded->email,
        //         'profile' => $decoded->users,
        //     ];
        //     return $this->respond($response);
        // } catch (\Throwable $th) {
        //     return $this->fail('Invalid Token');
        //     // echo $th;
        // }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
