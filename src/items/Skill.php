<?php

include_once '..\PgConnection.php';

class Skill {
    private $id;
    private $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
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
        $sql = "INSERT INTO Skill(skid, skillname)
                VALUES(" . $skill->id . "," . "'" . $skill->name . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    private static function create_from_json($json) {
        $skill = json_decode($json, true);

        if($skill == null)
            return null;

        $id = $skill['id'];
        $name = $skill['name'];

        return new Skill($id, $name);
    }
}