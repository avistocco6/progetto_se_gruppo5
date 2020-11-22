<?php

include_once 'PgConnection.php';

class Client {
    private $username;
    private $password;
    private $name;
    private $num_competences;
    private $role;

    public function __construct($username, $password, $name = "N/D",
                                $role = "Maintainer", $num_competences = 0) {
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->num_competences = $num_competences;
        $this->role = $role;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getNumCompetences()
    {
        return $this->num_competences;
    }

    public function setNumCompetences($num_competences)
    {
        $this->num_competences = $num_competences;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public static function save($json) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            //echo '<p style="color:rgb(255,0,0);">Error saving material</p>';
            return false;
        }

        $client = self::create_from_json($json);

        if($client == null) return false;

        $res = self::db_insert($connector, $client);

        pg_close($conn);

        return $res;
    }

    private static function db_insert($conn, $client) {
        $sql = "INSERT INTO Client(username, pass, clientname, ncompetence, clientrole)
                VALUES(". "'" . $client->username . "'," . "'" . $client->password . "'," .
                        "'" . $client->name . "'," . "'" . $client->num_competences . "'," .
                        "'" . $client->role . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    private static function create_from_json($json) {
        $client = json_decode($json, true);

        if($client == null)
            return null;

        $username = $client['username'];
        $password = $client['password'];
        $name = $client['name'];
        $role = $client['role'];

        return new Client($username, $password, $name, $role);
    }

    public static function assignSkill($json) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $assign = json_decode($json, true);

        $skill_id = $assign['skill_id'];
        $user = $assign['username'];

        $sql = "INSERT INTO Holding(username, idskill) VALUES(" . "'" . $user . "'," . $skill_id . ")";
        return $connector->query($sql) ? true : false;

        pg_close($conn);
    }
}