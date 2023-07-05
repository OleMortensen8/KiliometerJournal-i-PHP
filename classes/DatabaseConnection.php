<?php 

// Create a Database connection class
class DatabaseConnection {
    
    // Define database properties
    private $hostname;
    private $database;
    private $username;
    private $password;

    // Construct the class and assign values to properties
    public function __construct() {
        $this->hostname = $_ENV['HOST'];
        $this->database = $_ENV['DATABASE'];
        $this->username = $_ENV['USERNAME'];
        $this->password = $_ENV['PASSWORD'];
    }

    // Function to establish a PDO connection
    public function connectToDb() {
        try {
            return new PDO(sprintf('mysql:host=%s;dbname=%s', $this->hostname, $this->database), $this->username, $this->password );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Function to insert data into SQL table
    public function insertData($initials, $kmStart, $kmStop, $totalKm) {
        try {
            $statement = $this->connectToDb()->prepare("INSERT INTO Kilometer_list (initials, kmStart, kmStop, totalKm) VALUES (?, ?, ?, ?)");
            $statement->bindParam(1, $initials, PDO::PARAM_STR);
            $statement->bindParam(2, $kmStart, PDO::PARAM_INT);
            $statement->bindParam(3, $kmStop, PDO::PARAM_INT);
            $statement->bindParam(4, $totalKm, PDO::PARAM_INT);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Function to fetch data from SQL table
    public function getData() {
        $statement = $this->connectToDb()->query("SELECT * FROM Kilometer_list ORDER BY EntryID DESC");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Function to delete an entry from SQL table
    public function deleteEntry($id) {
        $statement = $this->connectToDb()->prepare("DELETE FROM Kilometer_list WHERE EntryID=:id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    } 
}