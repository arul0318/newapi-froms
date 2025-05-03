<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Database\Database;

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

        // Establishing the database connection
        $this->db = \Config\Database::connect();
        
        // Make sure the connection is valid
        if (!$this->db->connID) {
            throw new \RuntimeException('Unable to connect to the database.');
        }

        // Access the 'users' table dynamically via the DB connection
        $this->users = $this->db->table('users');
    }
}
