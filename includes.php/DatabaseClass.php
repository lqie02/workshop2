<?php

class DatabaseClass  {  
    private $host = "localhost"; // your host name  
    private $username = "root"; // your user name  
    private $password = ""; // your password  
    private $database = "db_fkfood"; // your database name  
    public $connection;


    public  function __construct(){
       $this->connection = new \mysqli($this->host, $this->username, $this->password, $this->database);

       if ($this->connection->connect_error) {
            throw new \Exception('Error: ' . $this->connection->error . '<br />Error No: ' . $this->connection->errno);
       }

       $this->connection->set_charset("utf8");
       $this->connection->query("SET SQL_MODE = ''");

    } 

  

    public function query($sql) {

        $query = $this->connection->query($sql);
        
        /*echo "<pre>";
        echo $sql;
        echo "<br/>";
        print_r($this->connection);*/

      
        if (!$this->connection->errno) {
            if ($query instanceof \mysqli_result) {
                $data = array();

                while ($row = $query->fetch_assoc()) {
                    $data[] = $row;
                }

                $result = new \stdClass();
                $result->num_rows = $query->num_rows;
                $result->row = isset($data[0]) ? $data[0] : array();
                $result->rows = $data;

                $query->close();

                return $result;
            } else {
                return true;
            }
        } else {
            throw new \Exception('Error: ' . $this->connection->error  . '<br />Error No: ' . $this->connection->errno . '<br />' . $sql);
        }
    }

    public function escape($value) {
        return $this->connection->real_escape_string($value);
    }

    public function countAffected() {
        return $this->connection->affected_rows;
    }

    public function getLastId() {
        return $this->connection->insert_id;
    }
    
    public function connected() {
        return $this->connection->ping();
    }
    
    public function __destruct() {
        $this->connection->close();
    }
}

?>