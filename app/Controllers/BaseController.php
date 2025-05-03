<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = [];
    protected $db;
    protected $users;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Connect to the database
        $this->db = \Config\Database::connect();

        // Optional: Only assign if table exists to prevent error
        if ($this->db->tableExists('users')) {
            $this->users = $this->db->table('users');
        } else {
            log_message('error', 'Table "users" does not exist.');
        }
    }
}
