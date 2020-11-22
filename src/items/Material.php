<?php


class Material {
    private $id;
    private $name;
    private $activity;

    function __construct($id, $name, $activity) {
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

    public static function save_from_json($file) {
        $conn = new PgConnection();
        $conn = $conn->connect();

        if($conn == null) {
            //echo '<p style="color:rgb(255,0,0);">Error saving material</p>';
            return false;
        }
        $json_data = file_get_contents($file);
        $material = json_decode($json_data, true);

        if($material == null)
            return false;

        $id = $material['id'];
        $name = $material['name'];
        $activity = $material['activity'];

        $res = Material::db_insert($conn, $id, $name, $activity);

        pg_close($conn);

        return $res;
    }

    private static function db_insert($conn, $id, $name, $activity) {
        $sql = "INSERT INTO Material(mid, name, idactivity)
                VALUES(" . $id . "," . $name . "," . $activity . ")";

        $insert_query = pg_query($conn, $sql);

        if(!$insert_query)
            return false;
        else
            return true;
    }
}