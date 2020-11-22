<?php

include_once '..\PgConnection.php';

class Material {
    private $id;
    private $name;
    private $activity;

    public function __construct($id, $name, $activity) {
        $this->id = $id;
        $this->name = $name;
        $this->activity = $activity;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function set_activity($activity) {
        $this->activity = $activity;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_activity() {
        return $this->activity;
    }

    public static function save($json) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            //echo '<p style="color:rgb(255,0,0);">Error saving material</p>';
            return false;
        }

        $material = self::create_from_json($json);

        if($material == null) return false;

        $res = self::db_insert($connector, $material);

        pg_close($conn);

        return $res;
    }

    private static function db_insert($conn, $material) {
        if($material->activity != null)
            $sql = "INSERT INTO Material(mid, name, idactivity)
                    VALUES(" . $material->id . "," . "'" . $material->name . "'" . "," . $material->activity . ")";
        else
            $sql = "INSERT INTO Material(mid, name)
                    VALUES(" . $material->id . "," . "'" . $material->name . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    private static function create_from_json($json) {
        $json_data = file_get_contents($json);
        $material = json_decode($json_data, true);

        if($material == null)
            return null;

        $id = $material['id'];
        $name = $material['name'];
        $activity = $material['activity'];

        return new Material($id, $name, $activity);
    }
}