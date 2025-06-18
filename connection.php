<?php
 
class Database {

    private static ?Database $instance = null;

    private PDO $connection;
 
    // Private constructor zodat er geen directe instantie van buitenaf kan worden gemaakt

    private function __construct() {

      $servername="127.0.0.1";
      $username="root";
      $password="benji";
      $dbname="Project";
 
        $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
 
        try {

            $this->connection = new PDO($dsn, $username, $password);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            die('Database connectie mislukt: ' . $e->getMessage());

        }

    }
 
    // Statische methode om de enige instantie van de class op te halen

    public static function getInstance(): Database {

        if (self::$instance === null) {

            self::$instance = new Database();

        }

        return self::$instance;

    }
 
    // Methode om de PDO-verbinding op te halen

    public function getConnection(): PDO {

        return $this->connection;

    }

}
 
// Voorbeeld van gebruik:

$db = Database::getInstance();

$conn = $db->getConnection();
 
// Query voorbeeld:

$stmt = $conn->query("SELECT * FROM users");

?>
 