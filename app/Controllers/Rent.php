<?php

namespace App\Controllers;

use App\Models\RentModel;
use App\Models\RoomModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Database\MySQLi\Builder;


date_default_timezone_set("Asia/Jakarta");

class Rent extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $rents = new RentModel();
        $data = $this->respond(['rent' => $rents->orderBy('id', "DESC")->findAll()], 200);
        return $data;
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new RentModel();
        $data = $model->getWhere(['user_id' => $id])->getResult();


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
        $model = new RentModel();
        helper(['form']);
        $rules = [
            'room_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'time_start' => 'required',
            'time_end' => 'required',
            'date' => 'required',
            'nama' => 'required|alpha_numeric_space',
            'no_telepon' => 'required|alpha_numeric_space',
            'remark' => 'required|alpha_numeric_punct',
            // 'is_valid' => 'required|numeric',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $endTime = $this->request->getVar('time_end');
        $timeNow = date("H:i:s");
        $expTime = $timeNow > $endTime;
        if ($expTime == true) {
            $exp = 1;
        } else {
            $exp = 0;
        }
        $Stringdate = $this->request->getVar('date');
        $date = date("Y-m-d", strtotime($Stringdate));

        $data = [
            'room_id' => $this->request->getVar('room_id'),
            'user_id' => $this->request->getVar('user_id'),
            'time_start' => $this->request->getVar('time_start'),
            'time_end' => $endTime,
            'date' => $date,
            'nama' => $this->request->getVar('nama'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'remark' => $this->request->getVar('remark'),
            'is_valid' => $exp,
        ];

        if ($exp != 0) {
            return $this->fail("Choose another time", 500);
        } else {
            $model->insert($data);
            $response = [
                'status' => 201,
                'error' => null,
                'message' => [
                    'success' => 'Rent Room Successfully'
                ]
            ];
            return $this->respondCreated($response);
        }
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
        $model = new RentModel();
        helper(['form']);
        $rules = [
            'room_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'time_start' => 'required',
            'time_end' => 'required',
            // 'date' => 'required',
            'nama' => 'required|alpha_numeric_space',
            'no_telepon' => 'required|alpha_numeric_space',
            'remark' => 'required|alpha_numeric_punct',
            // 'is_valid' => 'required|numeric',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $input = $this->request->getRawInput();
        $endTime = $input['time_end'];
        $timeNow = date("H:i:s");
        $expTime = $timeNow > $endTime;
        if ($expTime == true) {
            $exp = 1;
        } else {
            $exp = 0;
        }
        $Stringdate = $input['date'];
        $date = date("Y-m-d", strtotime($Stringdate));
        $data = [
            'room_id' => $input['room_id'],
            'user_id' => $input['user_id'],
            'time_start' => $input['time_start'],
            'time_end' => $input['time_end'],
            'date' => $date,
            'nama' => $input['nama'],
            'no_telepon' => $input['no_telepon'],
            'remark' => $input['remark'],
            'is_valid' => $exp,
        ];
        if ($exp != 0) {
            return $this->fail("Choose another time", 500);
        } else {
            $model->update($id, $data);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Rent Room Updated'
                ]
            ];
            return $this->respondUpdated($response);
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new RentModel();
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
