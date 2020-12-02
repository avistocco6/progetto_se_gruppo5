<?php

include_once '..\PgConnection.php';

class Typology {
    private $description;

    public function __construct($description) {
        $this->description = $description;
    }

    public static function save($description) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = self::dbInsert($connector, $description);

        pg_close($conn);

        return $res;
    }

    private static function dbInsert($conn, $description) {
        $sql = "INSERT INTO Typology(description)
                VALUES(". "'". $description . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    public static function getTypologies() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT * FROM Typology ORDER BY tid");

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

    public static function updateTypology($id, $description) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("UPDATE Typology SET description =" .
            "'" . $description . "' WHERE tid = " . $id);

        pg_close($conn);

        return $res ? true : false;
    }
}