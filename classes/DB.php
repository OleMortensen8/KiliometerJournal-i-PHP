<?php 

class DB {
    private $hostname, $database, $username, $password;

    public function __construct() {
        $this->hostname = $_ENV['HOST'];
        $this->database = $_ENV['DATABASE'];
        $this->username = $_ENV['USERNAME'];
        $this->password = $_ENV['PASSWORD'];
    }

    public function DBCONNECT() {
        try {
            return new PDO(sprintf('mysql:host=%s;dbname=%s', $this->hostname, $this->database),
                $this->username,
                $this->password
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    

    public function sendsDataToSql($ini, $kmStart, $kmStop, $samledetal) {
        try {
            $statement = $this->DBCONNECT()->prepare("INSERT INTO Kiliometer_liste (initialer, kmStart, kmSlut, samledeKmTal) VALUES (?, ?, ?, ?)");
            $statement->bindParam(1, $ini, PDO::PARAM_STR);
            $statement->bindParam(2, $kmStart, PDO::PARAM_INT);
            $statement->bindParam(3, $kmStop, PDO::PARAM_INT);
            $statement->bindParam(4, $samledetal, PDO::PARAM_INT);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getDataToSql() {
        $statement = $this->DBCONNECT()->query("SELECT * FROM Kiliometer_liste ORDER BY EntryID DESC");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteEntry($id) {
        $statement = $this->DBCONNECT()->prepare("DELETE FROM Kiliometer_liste WHERE EntryID=:id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}