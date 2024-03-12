<?php

class DbConnection {
    private string $hostname       = "";
    private string $dbname         = "";
    private string $dbusername     = "";
    private string $dbpassword     = "";
    protected $mysqli;

    public function __construct(){
        $this->mysqli = new mysqli($this->hostname, $this->dbusername, $this->dbpassword, $this->dbname);

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }   
    }
}


?>