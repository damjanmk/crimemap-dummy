<?php
require_once '../config/dbfields.php';
/**
 * Description of selector
 *
 * @author Damjan
 */
class selector {

    private $query;

    function __construct() {
        $this->query = "SELECT " . get_field_id(). ', ' . get_field_type() . ', ' . get_field_date_issue(). ', ' . get_field_description() . ', ' . get_field_latitude() . ', ' . get_field_longitude() . ' FROM ' . get_field_table() . ' ';
    }

    public function get_query(){
        return $this->query;
    }

    public function where_shto($shto, $first) {
        if ($first)
            $this->query .= "WHERE ";
        else
            $this->query .= "AND ";
        $this->query .= get_field_type() . " = '" . $shto . "' ";
    }

    public function where_grad($grad, $first) {
        if ($first)
            $this->query .= "WHERE ";
        else
            $this->query .= "AND ";
        $this->query .= get_field_city() . " = '" . $grad . "' ";
    }

    public function where_datum($od, $do, $first) {
        if ($first)
            $this->query .= "WHERE ";
        else
            $this->query .= "AND ";
        if($od != null){
            if($do != null)
                $this->query .= get_field_date() . " >= '" . $od . "' AND datum <= '" . $do . "' ";
            else
                $this->query .= get_field_date() . " >= '" . $od . "' ";
        }
        else
            $this->query .= get_field_date() . " <= '" . $do . "' ";
    }

    public function where_opis($o, $first) {
        if ($first)
            $this->query .= "WHERE ";
        else
            $this->query .= "AND ";
        $this->query .= get_field_description() . " LIKE '" . $o . "' ";
    }

    public function where_den($den, $first) {
        if ($first)
            $this->query .= "WHERE ";
        else
            $this->query .= "AND ";
        $this->query .= "DAYOFWEEK(" . get_field_date() . ") = '" . $den . "' ";
    }
}

?>
