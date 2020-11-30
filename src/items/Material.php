<?php

include_once '..\PgConnection.php';

class Material {
    private $name;
    private $activity;

    public function __construct($name, $activity) {
        $this->name = $name;
        $this->activity = $activity;
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function set_activity($activity) {
        $this->activity = $activity;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_activity() {
        return $this->activity;
    }

    public static function save($name, $activity) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            //echo '<p style="color:rgb(255,0,0);">Error saving material</p>';
            return false;
        }

        $res = self::db_insert($connector, $name, $activity);

        pg_close($conn);

        return $res;
    }

    private static function db_insert($conn, $name, $activity) {
        if($activity != null)
            $sql = "INSERT INTO Material(matname, idactivity)
                    VALUES(" . "'" . $name . "'," . $activity . ")";
        else
            $sql = "INSERT INTO Material(matname)
                    VALUES(" . "'" . $name . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    public static function get_materials() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("SELECT mid, matname FROM Material ORDER BY mid");

        if(!$res) return false;

        $json_string = "[";
        while($row = pg_fetch_row($res)) {
            $json_string = $json_string . "{\n" .'"id":' . $row[0] . ",\n" . '"name":' .
                '"' . $row[1] . '"' . "\n}" . ",\n";
        }
        if(strlen($json_string) > 1) {
            $json_string = substr($json_string, 0, strlen($json_string) - 2);
            $json_string = $json_string . "]";
        } else $json_string = null;
        pg_close($conn);

        return $json_string;
    }

    public static function updateMaterial($id, $name) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("UPDATE Material SET matname =" .
                        "'" . $name . "' WHERE mid = " . $id);

        pg_close($conn);

        return $res ? true : false;
    }
}
