<?php

//This class create the connection with the database and the function get and set allow to read ad write data.
class PgConnection
{
    private $host = 'localhost';
    private $db = 'ProgettoSE';
    private $username = 'gruppo5';
    private $password = 'progettoSE2020';
    private $port = '5432';

    public function connect(){
        // host=host db=DB user=user password=password
        $connection_string = "host=" . $this->host . " port= " . $this->port . " dbname=" . $this->db .
            " user=" . $this->username . " password= " . $this->password;

        $connection = pg_connect($connection_string);

        if (!$connection) return null;

        //echo "Opened database successfully<br/>";
        return $connection;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPort($port) {
        $this->port = $port;
    }

    public function setHost($host) {
        $this->username = $host;
    }

    public function setDb($db) {
        $this->username = $db;
    }

    public function setPassword($password) {
        $this->username = $password;
    }

    public function getUsername() {
        return $this->username;
    }

    public function  getDb() {
        return $this->db;
    }

    public function  getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }

    public function query($sql_string) {
        return pg_query($sql_string);
    }
}
?>
