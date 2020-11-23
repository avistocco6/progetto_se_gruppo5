<?php

include_once '..\PgConnection.php';

class Typology {
    private $description;

    public function __construct($description) {
        $this->description = $description;
    }

    public function get_description() {
        return $this->description;
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
        $sql = "INSERT INTO Typology(description)
                VALUES(". "'". $typology->description . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    private static function create_from_json($json) {
        $typology = json_decode($json, true);

        if($typology == null)
            return null;

        $description = $typology['description'];

        return new Typology($description);
    }

    public static function get_typologies() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("SELECT * FROM Typology");

        if(!$res) return false;

        $json_string = "[";
        while($row = pg_fetch_row($res)) {
            $json_string = $json_string . "{\n" .'"id":' . $row[0] . ",\n" . '"description":' .
                '"' . $row[1] . '"' . "\n}" . ",\n";
        }
        if(strlen($json_string) > 1) {
            $json_string = substr($json_string, 0, strlen($json_string) - 2);
            $json_string = $json_string . "]";
        } else $json_string = null;

        pg_close($conn);

        return $json_string;
    }
}