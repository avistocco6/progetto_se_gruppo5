<?php


class PgConnection
{
    private $host = '';
    private $db = '';
    private $username = '';
    private $password = '';
    private $port = '';

    public function connect(){
        // host=host db=DB user=user password=password
        $connection_string = "host=" . $this->host . " port= " . $this->port . " dbname=" . $this->db .
            " user=" . $this->username . " password= " . $this->password;

        $connection = pg_connect($connection_string);

        if (!$connection) return null;

        echo "Opened database successfully<br/>";
        return $connection;
    }

    public function set_username($username) {
        $this->username = $username;
    }

    public function set_port($port) {
        $this->port = $port;
    }

    public function set_host($host) {
        $this->username = $host;
    }

    public function set_db($db) {
        $this->username = $db;
    }

    public function set_password($password) {
        $this->username = $password;
    }

    public function get_username() {
        return $this->username;
    }

    public function  get_db() {
        return $this->db;
    }

    public function  get_host() {
        return $this.$this->host;
    }

    public function get_port() {
        return $this->port;
    }
}
?>
