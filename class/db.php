<?php
 
include_once 'constant.php';
 
  
class db extends mysqli {

    //put your code here

    public $connections;
    public $last;
    public $insertId;
   

    public function __construct() {
      
        $this->connections = new mysqli(server, username, password, db);
        if (mysqli_connect_errno()) {
            trigger_error('Error connecting to host. ' . $this->connections->error, E_USER_ERROR);
        }else{
        //   echo " Succesfull </br>";
        }
		
	 
		
    }
	 

    public function runQuery($queryStr) {
        if (!$result = $this->connections->query($queryStr)) {
            trigger_error('Error executing query: ' . $queryStr . ' -
' . $this->connections->error, E_USER_ERROR);
        } else {
            $this->last = $result;
            $this->insertId = $this->connections->insert_id;
            return TRUE;
        }
    }

    public function getData() {
        return $this->last->fetch_array(MYSQLI_ASSOC);
    }

    public function deleteData($table, $condition, $limit) {
        $limit = ( $limit == '' ) ? '' : ' LIMIT ' . $limit;
        $delete = "DELETE FROM {$table} WHERE {$condition} {$limit}";
        $this->runQuery($delete);
    }

    public function numRows() {
        return $this->last->num_rows;
    }

    public function getId() {
        return $this->connections->insert_id;
    }

  
    public function updateData($table, $changes, $condition) {
        $update = "UPDATE " . $table . " SET ";
        foreach ($changes as $field => $value) {
            $update .= "`" . $field . "`='{$value}',";
        }
        // remove our trailing ,
        $update = substr($update, 0, -1);
        if ($condition != '') {
            $update .= "WHERE " . $condition;
        }
        $this->runQuery($update);
        return true;
    }

    public function insertData($table, $data) {
        // setup some variables for fields and values
        $fields = "";
        $values = "";
        // populate them
        foreach ($data as $f => $v) {
            $fields .= "`$f`,";
            $values .= ( is_numeric($v) && ( intval($v) == $v ) ) ?
                $v . "," : "'$v',";
        }
        // remove our trailing ,
        $fields = substr($fields, 0, -1);
        // remove our trailing ,
        $values = substr($values, 0, -1);
        $insert = "INSERT INTO $table ({$fields}) VALUES({$values})";
        //echo $insert;
        return $this->runQuery($insert);
//        return true;
    }

    public function cleanData($value) {
        // Stripslashes
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        // Quote value
        if (version_compare(phpversion(), "4.3.0") == "-1") {
            $value = $this->connections->escape_string($value);
        } else {
            $value = $this->connections->real_escape_string($value);
        }
        return $value;
    }
	
	public function lastInsertedID(){
		return $this->insertId = $this->connections->insert_id;
		}

   
    public function affectedData() {
        return $this->last->affected_rows;
    }

			
    public function __deconstruct() {
        $this->connections->close();
    }

}