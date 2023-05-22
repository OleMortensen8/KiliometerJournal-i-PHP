<?php class DB{
    
    private $hostname = '',
        $username = '',
        $password = '',
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
        
       public function DBCONNECT(){
        try{
            return new PDO($this->hostname, $this->username, $this->password, $this->options);
        }catch(Exeception $e){
            return $e->getmessage();
        }
    }

    public function sendsDataToSql($ini, $kmStart, $kmStop, $samledetal){
       $statement = $this->DBCONNECT()->prepare("INSERT INTO kiliometerliste (initialer, kmStart, kmSlut, samledeKmTal) VALUES (?, ?, ?, ?)");
       $statement->bindParam(1, $ini, PDO::PARAM_STR);
       $statement->bindParam(2, $kmStart, PDO::PARAM_INT);
       $statement->bindParam(3, $kmStop, PDO::PARAM_INT);
       $statement->bindParam(4, $samledetal, PDO::PARAM_INT);
       $statement->execute();
       header("Location: features.php");
    }

    public function getDataToSql(){
        $statement = $this->DBCONNECT()->query("SELECT * FROM kiliometerliste
        ORDER BY EntryID DESC LIMIT 5");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteEntry($id){
        $this->DBCONNECT()->query("DELETE FROM kiliometerliste WHERE EntryID = $id");
    } 
}
?>