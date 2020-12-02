<?php

include_once '..\PgConnection.php';

class Site {
    private $branch;
    private $department;

    public function __construct($branch, $department) {
        $this->department = $department;
        $this->branch = $branch;
    }

    public static function save($branch, $department) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = self::dbInsert($connector, $branch, $department);

        pg_close($conn);

        return $res;
    }


    private static function dbInsert($conn, $branch, $department) {
        $sql = "INSERT INTO Site(branch, department)
                VALUES(" . "'" . $branch . "'" . "," . "'" . $department . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    public static function getSites() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT * FROM Site ORDER BY sid");

        if(!$res) return false;

        $json_string = "[";
        while($row = pg_fetch_row($res)) {
            $json_string = $json_string . "{\n" .'"id":' . $row[0] . ",\n" . '"factory":' .
                '"' . $row[1] . '"' . ",\n" . '"area":' .
                '"' . $row[2] . '"' . "\n}" . ",\n";
        }
        if(strlen($json_string) > 1) {
            $json_string = substr($json_string, 0, strlen($json_string) - 2);
            $json_string = $json_string . "]";
        } else $json_string = null;

        pg_close($conn);

        return $json_string;
    }

    public static function updateSite($id, $branch, $department) {
        $connector = new PgConnection();
        $conn = $connector->connect();


        $res = $connector->query("UPDATE Site SET branch = " .
            "'" . $branch . "', department = " . "'" . $department ."'" . "WHERE sid = " . $id);

        pg_close($conn);
        return $res ? true : false;
    }
}