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

    public static function save_from_json($file) {
        $conn = new PgConnection();
        $conn = $conn->connect();

        if($conn == null) {
            //echo '<p style="color:rgb(255,0,0);">Error saving typology</p>';
            return false;
        }
        $json_data = file_get_contents($file);
        $typology = json_decode($json_data, true);

        if($typology == null)
            return false;

        $id = $typology['id'];
        $description = $typology['description'];

        $res = Typology::db_insert($conn, $id, $description);

        pg_close($conn);

        return $res;
    }

    private static function db_insert($conn, $id, $description) {
        $sql = "INSERT INTO Typology(tid, description)
                VALUES(" . $id . "," . "'" . $description . "'" . ")";

        $insert_query = pg_query($conn, $sql);

        if(!$insert_query)
            return false;
        else
            return true;
    }
}