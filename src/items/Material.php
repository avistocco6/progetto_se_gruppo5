<?php

include_once '..\PgConnection.php';

class Material {
    private $name;
    private $activity;

    public function __construct($name, $activity) {
        $this->name = $name;
        $this->activity = $activity;
    }

    public static function save($name, $activity = null) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = self::dbInsert($connector, $name, $activity);

        pg_close($conn);

        return $res;
    }

    private static function dbInsert($conn, $name, $activity) {
        if($activity != null)
            $sql = "INSERT INTO Material(matname, idactivity)
                    VALUES(" . "'" . $name . "'," . $activity . ")";
        else
            $sql = "INSERT INTO Material(matname)
                    VALUES(" . "'" . $name . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    public static function getMaterials() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT mid, matname FROM Material ORDER BY mid");

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

        $res = $connector->query("UPDATE Material SET matname =" .
                        "'" . $name . "' WHERE mid = " . $id);

        pg_close($conn);

        return $res ? true : false;
    }
}
