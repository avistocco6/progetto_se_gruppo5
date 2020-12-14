<?php

include_once '..\PgConnection.php';

class Skill {
    private static $instance = null;

    private function __construct() {
        // instance init
    }

    private function __clone() {
        // make unclonable the object
    }

    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new Skill();
        }
        return static::$instance;
    }

    /**
     * store a new skill
     * @param $name
     * @return bool
     */
    public function save($name) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }
        if(!$this->checkSkill($name, $connector))
            return false;

        $res = $this->dbInsert($connector, $name);

        pg_close($conn);

        return $res;
    }

    public function checkSkill($name, $connector) {
        if($name == "")
            return false;
        $res = $connector->query("SELECT * FROM Skill WHERE skillname = "
            . "'" . $name . "'");

        if(pg_num_rows($res) > 0)
            return false;

        return true;
    }

    private function dbInsert($conn, $name) {
        $sql = "INSERT INTO Skill(skillname)
                VALUES(" . "'" . $name . "'" . ")";

        $res = $conn->query($sql);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        return $res;
    }

    /**
     * get all stored skills
     * @return string|null
     */
    public function getSkills()
    {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return null;
        }

        $res = $connector->query("SELECT * FROM Skill ORDER BY skid");

        if(!$res) {
            pg_close($conn);
            return null;
        }
        $json_string = "[";
        while ($row = pg_fetch_row($res)) {
            $json_string = $json_string . "{\n" . '"id":' . $row[0] . ",\n" . '"name":' .
                '"' . $row[1] . '"' . "\n}" . ",\n";
        }
        if(strlen($json_string) > 1) {
            $json_string = substr($json_string, 0, strlen($json_string) - 2);
            $json_string = $json_string . "]";
        } else $json_string = null;

        pg_close($conn);

        return $json_string;
    }

    /**
     * update a stored skill
     * @param $id
     * @param $name
     * @return bool
     */
    public function updateSkill($id, $name) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        if(!$this->checkSkill($name, $connector))
            return false;
        if($id < 1)
            return false;

        $res = $connector->query("UPDATE Skill SET skillname =" .
            "'" . $name . "' WHERE skid = " . $id);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }

    /**
     * delete a stored Skill by id
     * @param $id
     * @return bool
     */
    public function removeSkill($id) {
        if($id < 1)
            return false;
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $res = $connector->query("DELETE FROM Skill WHERE skid =" . $id);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }
}