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

        // Check if the connection is successful
        if ($this->db->connID === false) {
            log_message('error', 'Database connection failed!');
        } else {
            log_message('info', 'Database connection successful');
            
            // Accessing the 'users' table dynamically via the DB connection
            $this->users = $this->db->table('users');
        }
    }
}
