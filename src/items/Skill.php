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

    public static function save($json) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            //echo '<p style="color:rgb(255,0,0);">Error saving material</p>';
            return false;
        }

        $skill = self::create_from_json($json);

        if($skill == null) return false;

        $res = self::db_insert($connector, $skill);

        pg_close($conn);

        return $res;
    }

    private static function db_insert($conn, $skill) {
        $sql = "INSERT INTO Skill(skillname)
                VALUES(" . "'" . $skill->name . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    private static function create_from_json($json) {
        $skill = json_decode($json, true);

        if($skill == null)
            return null;

        $name = $skill['name'];

        return new Skill($name);
    }

    public static function get_skills() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("SELECT * FROM Skill");

        if(!$res) return false;

        $json_string = "[";
        while($row = pg_fetch_row($res)) {
            $json_string = $json_string . "{\n" .'"id":' . $row[0] . ",\n" . '"name":' .
                '"' . $row[1] . '"' . "\n}" . ",\n";
        }
        $json_string = substr($json_string, 0, strlen($json_string)-2);
        $json_string = $json_string . "]";

        pg_close($conn);

        return $json_string;
    }
}