<?php
require_once 'dbconfig.php';

/**
 * Klasata za konekcija so baza *
 */
class Konekcija{
	private $host;
	private $username;
	private $password;
	private $database;
	private $connection;
        
	function __construct(){
            $this->host = get_host();
            $this->username = get_username();
            $this->password = get_password();
            $this->database = get_database();
		$this->connect($this->host, $this->username, $this->password);
		$this->select_db($this->database);
		mysql_query("SET NAMES 'utf8'");
	}
	
	public function connect($host, $username, $password){
		$this->connection = mysql_connect($host,$username,$password);
	}

        public function disconnect()
        {
            $this->connection = mysql_close();
        }
	public function select_db($database){
		mysql_select_db($database);
	}

        /**
         * Prima SQL i go izvrsuva
         *
         * @param string $query
         * @return Rezultatot od query-to ili soodvetniot error
         */
	public function query($query){
		$result = mysql_query( $query, $this->connection);
		if(mysql_error()!=null) 
			return mysql_error();
		else if(mysql_error()==null)
			return $result; 
	}
	/**
         * Razlikata e vo toa sto vrakja id na novovnesenata torka
         *
         * @param string $query
         * @return id na novovnesenata torka ili soodvetniot error
         */
	public function query_insert($query){
		mysql_query($query, $this->connection);
		if(mysql_error()!=null)
			return mysql_error();
		else if(mysql_error()==null)
			return mysql_insert_id();
	}	
}


