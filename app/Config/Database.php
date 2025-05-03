namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Default connection group.
     */
    public string $defaultGroup = 'default';

    /**
     * Default database connection settings.
     *
     * @var array<string, mixed>
     */
    public $default = [
        'DSN'      => '',
        'hostname' => 'mysql',   // Docker service name for MySQL container
        'username' => 'root',    // Username from Docker Compose
        'password' => 'my-secret-pw',     // Password from Docker Compose
        'database' => 'mydb',    // Database name from Docker Compose
        'DBDriver' => 'MySQLi',
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
    ];

    /**
     * Database connection settings for PHPUnit tests.
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1', // Localhost for SQLite tests
        'username'    => '',          // No user for SQLite
        'password'    => '',          // No password for SQLite
        'database'    => ':memory:',  // In-memory SQLite database for tests
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    /**
     * Constructor
     * Ensures the correct database group is set when running tests.
     */
    public function __construct()
    {
        parent::__construct();

        // Automatically switch to the 'tests' connection group when running automated tests
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
