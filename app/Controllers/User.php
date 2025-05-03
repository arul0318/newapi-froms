<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;
    //Get Api
    public function index()
    {
        $users = $this->users->get()->getResultArray(); // get all users as array
        return $this->respond($users);
    }
    public function postApi()
    {
        $data=$this->request->getJSON(true);
        if(empty($data['name']))
        {
            return $this->respondCreated([
                    'status' => 'error',
                    'message' => 'name is missing',
                ]);
        }else if(empty($data['emailid']))
        {
            return $this->respondCreated([
                'status' => 'error',
                'message' => 'emailid is missing',
            ]);
        }else if(empty($data['age']))
        {
            return $this->respondCreated([
                'status' => 'error',
                'message' => 'age is missing',
            ]);
        }else if(empty($data['dob']))
        {
            return $this->respondCreated([
                'status' => 'error',
                'message' => 'date of brith is missing',
            ]);
        }else if(empty($data['message']))
        {
            return $this->respondCreated([
                'status' => 'error',
                'message' => 'meassage is missing',
            ]);
        }else{
            $data['id']=rand(0,999);
            $dob=$data['dob'];
            $data['dob']=date('Y-m-d', strtotime($dob));

            //echo json_encode($data);exit;
            $this->users->insert($data);
            return $this->respondCreated([
              'status' => 'Success',
              'message' => 'User created successfully',
            ]);
        }
       
    }
}
