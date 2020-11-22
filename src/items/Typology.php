<?php

include_once '..\PgConnection.php';

class Typology {
    private $id;
    private $description;

    public function __construct($id, $description) {
        $this->id = $id;
        $this->description = $description;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_description() {
        return $this->description;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function set_description($description) {
        $this->description = $description;
    }

    public static function save($json) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            //echo '<p style="color:rgb(255,0,0);">Error saving typology</p>';
            return false;
        }

        $typology = self::create_from_json($json);

        if($typology == null) return false;

        $res = self::db_insert($connector, $typology);

        pg_close($conn);

        return $res;
    }

    private static function db_insert($conn, $typology) {
        $sql = "INSERT INTO Typology(tid, description)
                VALUES(" . $typology->id . "," . "'" . $typology->description . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    private static function create_from_json($json) {
        $json_data = file_get_contents($json);
        $typology = json_decode($json_data, true);

        if($typology == null)
            return null;

        $id = $typology['id'];
        $description = $typology['description'];

        return new Typology($id, $description);
    }
}