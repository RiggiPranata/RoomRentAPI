<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $users = new UserModel();
        return $this->respond(['users' => $users->findAll()], 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new UserModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No data found');
        }
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
        $model = new UserModel();
        helper(['form']);
        $rules = [
            'password' => 'min_length[6]',
            'confpassword' => 'matches[password]',
            'nama' => 'alpha_space',
            'no_telepon' => 'numeric',
            'kelas' => 'alpha_numeric_space',
            'semester' => 'numeric',
            'jurusan' => 'alpha_numeric_space'
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $input = $this->request->getRawInput();
        $data = [
            'password' => password_hash($input['password'], PASSWORD_BCRYPT),
            'nama' => $input['nama'],
            'no_telepon' => $input['no_telepon'],
            'kelas' => $input['kelas'],
            'semester' => $input['semester'],
            'jurusan' => $input['jurusan'],
        ];
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'User Data Updated'
            ]
        ];
        return $this->respondUpdated($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new UserModel();
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Your Account has been deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound("Data not Found");
        }
    }
}
