<?php

namespace App\Controllers;

use App\Models\RoomModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Database\MySQLi\Builder;

class Room extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    public function index()
    {
        $rooms = new RoomModel();
        return $this->respond(['rooms' => $rooms->findAll()], 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {

        $model = new RoomModel();
        $data = $model->getWhere(['room_id' => $id])->getResult();
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
        $model = new RoomModel();
        helper(['form']);
        $user = new Me();
        $profile = $user->index();
        $rules = [
            'room_name' => 'required|alpha_numeric_punct|is_unique[rooms.room_name,room_name]',
            'floor' => 'required|numeric',
            'building' => 'required|alpha_numeric_space',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $data = [
            'room_name' => $this->request->getVar('room_name'),
            'floor' => $this->request->getVar('floor'),
            'building' => $this->request->getVar('building'),
            'is_ready' => 0,
        ];
        $model->insert($data);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Room has been added'
            ]
        ];
        return $this->respondCreated($response);
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
        $model = new RoomModel();
        helper(['form']);
        $rules = [
            'room_name' => 'alpha_numeric_punct',
            'floor' => 'numeric',
            'building' => 'alpha_numeric_space',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $input = $this->request->getRawInput();
        $data = [
            'room_name' => $input['room_name'],
            'floor' => $input['floor'],
            'building' => $input['building'],
            'is_ready' => $input['is_ready'],
        ];
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Room Updated'
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
        $model = new RoomModel();
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Data has been deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound("Data not Found");
        }
    }
}
