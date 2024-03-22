<?php
class Db{
    //Database connection variable
    protected static $connection;

    //Connection initialization function
    public function connect(){
        //Initiate connection
        self::$connection = new mysqli("localhost", "root", "", "demo_lab03");

        // Check connection
        if (self::$connection->connect_error) {
            die("Database connection failed: " . self::$connection->connect_error);
        }

        self::$connection->set_charset('utf8');
        return self::$connection;
    }

    //The function executes the query statement
    public function query_execute($queryString){
        //Execute query execution, query is a function of mysqli library
        $result = self::$connection->query($queryString);

        // Check for errors
        if ($result === false) {
            die("Query execution failed: " . self::$connection->error);
        }

        return $result;
    }

    //The implementation function returns an array of result lists
    public function select_to_array($queryString){
        $rows = array();
        $result = $this->query_execute($queryString);

        if ($result === false) return false;

        // while loop is used to output the data array to each element
        while ($item = $result->fetch_assoc()) {
            $rows[] = $item;
        }

        return $rows;
    }
}
?>