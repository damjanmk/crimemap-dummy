<?php
require './config/connect.php';
//not done
class inserter {
    private $query;

    function _construct(){
        $this->query = "INSERT INTO nastani ";
    }

    public function all($values_array){
//        $this->query .= "(";
//        foreach($values_array as $value){
//            $this->query .= $value . ", ";
//        }
//        $this->query = substr($this->query, 0, strlen($this->query) - 2);
//        $this->query .= ") ";

        $this->query .= "VALUES(";
        foreach($values_array as $value){
            $this->query .= "'" . $value . "', ";
        }
        $this->query = substr($this->query, 0, strlen($this->query) - 2);
        $this->query .= ")";
    }
}
?>
