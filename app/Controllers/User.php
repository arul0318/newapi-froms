<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;

    // GET /user
    public function index()
    {
        $users = $this->users->get()->getResultArray();
        return $this->respond($users);
    }

    // POST /user
    public function postApi()
    {
        $data = $this->request->getJSON(true);

        if (empty($data['name'])) {
            return $this->respondCreated([
                'status' => 'error',
                'message' => 'name is missing',
            ]);
        } elseif (empty($data['emailid'])) {
            return $this->respondCreated([
                'status' => 'error',
                'message' => 'emailid is missing',
            ]);
        } elseif (empty($data['age'])) {
            return $this->respondCreated([
                'status' => 'error',
                'message' => 'age is missing',
            ]);
        } elseif (empty($data['dob'])) {
            return $this->respondCreated([
                'status' => 'error',
                'message' => 'date of birth is missing',
            ]);
        } elseif (empty($data['message'])) {
            return $this->respondCreated([
                'status' => 'error',
                'message' => 'message is missing',
            ]);
        } else {
            $data['id'] = rand(0, 999);
            $data['dob'] = date('Y-m-d', strtotime($data['dob']));

            $this->users->insert($data);

            return $this->respondCreated([
                'status' => 'success',
                'message' => 'User created successfully',
            ]);
        }
    }
}
