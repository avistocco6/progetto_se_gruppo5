<?php

include_once '..\PgConnection.php';

class Skill {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function get_name() {
        return $this->name;
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public static function save($name) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = self::db_insert($connector, $name);

        pg_close($conn);

        return $res;
    }

    private static function db_insert($conn, $name) {
        $sql = "INSERT INTO Skill(skillname)
                VALUES(" . "'" . $name . "'" . ")";

        return $conn->query($sql) ? true : false;
    }


    public static function get_skills()
    {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("SELECT * FROM Skill ORDER BY skid");

        if (!$res) return false;

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

    public static function updateSkill($id, $name) {
        $connector = new PgConnection();
        $conn = $connector->connect();


        $res = pg_query("UPDATE Skill SET skillname =" .
            "'" . $name . "' WHERE skid = " . $id);

        pg_close($conn);

        return $res ? true : false;
    }
}