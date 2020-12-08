<?php

include_once '..\PgConnection.php';

class User {
    private static  $instance = null;

    private function __construct() {
        // instance init
    }

    private function __clone() {
        // make unclonable the object
    }

    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new Client();
        }
        return static::$instance;
    }

    /**
     * store a new user in the database
     *
     * @param $username
     * @param $password
     * @param $role
     * @param null $name
     * @return bool
     */
    public function save($username, $password, $role, $email, $name = null) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = $this->db_insert($connector, $username, $password, $role, $name, $email);

        pg_close($conn);

        return $res;
    }

    private function db_insert($conn, $username, $password, $role, $name, $email) {
        $sql = "INSERT INTO Client(username, pass, clientname, ncompetence, clientrole, email)
                VALUES(". "'" . $username . "'," . "'" . $password . "'," .
                        "'" . $name . "',". "'" . $role . "'" . ",". "'" . $email . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    /**
     * assign a skill to a maintainer
     * @param $json
     * @return bool
     */
    public function assignSkill($username, $skillname) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $ret = $connector->query("SELECT clientrole, ncompetence FROM Client where username =" . "'" . $username . "'");

        if($ret[0] != 'maintainer') {
            pg_close($conn);
            return false;
        }

        $ncompet = $ret[1];

        $ret = $connector->query("SELECT skid FROM Skill WHERE skillname =" . "'" . $skillname . "'");
        $skid = $ret[0];

        $sql = "INSERT INTO Holding(username, idskill) VALUES(" . "'" . $username . "'," . $skid . ")";
        $connector->query("UPDATE Client SET ncompetence =" . $ncompet+1 . "WHERE username =" . "'" . $username . "'");
        pg_close($conn);

        return $connector->query($sql) ? true : false;
    }

    /**
     * remove an user from the system
     * @param $username
     * @return bool
     */
    public function removeUser($username) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $res = $connector->query("DELETE FROM Client WHERE username =" . "'" . $username . "'");

        pg_close($conn);
        return $res ? true : false;
    }

    /**
     * update user s password
     *
     * @param $username
     * @param $password
     * @return bool
     */
    public function updatePassword($username, $password) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $res = $connector->query("UPDATE Client SET pass =" . "'" . $password . "'" . "WHERE username ="
                . "'" . $username . "'");

        pg_close($conn);
        return $res ? true : false;
    }

    /**
     * update user s email
     * @param $username
     * @param $email
     * @return bool
     */
    public function updateEmail($username, $email) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $res = $connector->query("UPDATE Client SET email =" . "'" . $email . "'" . "WHERE username ="
            . "'" . $username . "'");

        pg_close($conn);
        return $res ? true : false;
    }

    /**
     * get all stored users
     * @return string|null
     */
    public function getUsers() {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return null;
        }

        $res = $connector->query("SELECT username, clientname, pass, email FROM Client ORDER BY username");

        if(!$res) {
            pg_close($conn);
            return null;
        }

        $json_string = "[";
        while($row = pg_fetch_row($res)) {
            $json_string = $json_string . "{\n" .'"username":' . $row[0] . ",\n" . '"name":' .
                '"' . $row[1] . '"' . ",\n" . '"password":' . '"' . $row[2] . '"' .",\n" . '"email":' . '"' . $row[3] . '"' ."\n}" . ",\n";
        }
        if(strlen($json_string) > 1) {
            $json_string = substr($json_string, 0, strlen($json_string) - 2);
            $json_string = $json_string . "]";
        } else $json_string = null;

        pg_close($conn);

        return $json_string;
    }

    /**
     * Check if the inserted password is correct for given username
     * @param $username
     * @param $password
     * @return bool|null
     */
    public function checkPassword($username, $password) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return null;
        }

        $res = $connector->query("SELECT * FROM Client WHERE pass=" . "'" . $password . "'" .
                "AND username=" . "'" . $username . "'");
        if(pg_num_rows($res) != 1)
            return false;
        else
            return true;
    }
}
