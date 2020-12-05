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

        $res = $this->dbInsert($connector, $name);

        pg_close($conn);

        return $res;
    }

    private function dbInsert($conn, $name) {
        $sql = "INSERT INTO Skill(skillname)
                VALUES(" . "'" . $name . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    /**
     * get all stored skills
     * @return string|null
     */
    public function getSkills()
    {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT * FROM Skill ORDER BY skid");

        if (!$res) return null;

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


        $res = $connector->query("UPDATE Skill SET skillname =" .
            "'" . $name . "' WHERE skid = " . $id);

        pg_close($conn);

        return $res ? true : false;
    }
}