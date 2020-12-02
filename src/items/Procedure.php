<?php

include_once '..\PgConnection.php';

class Procedure {
    private $description;
    private $smp;
    private $activity;

    public function __construct($description, $activity = null, $smp = null) {
        $this->description = $description;
        $this->activity = $activity;
        $this->smp = $smp;
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
        $sql = "INSERT INTO MainProcedure(description)
                VALUES(" . "'" . $description . "')";

        return $conn->query($sql) ? true : false;
    }

    public static function addSkill($skill_id, $procedure_id) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $sql = "INSERT INTO SPAssignment(ids, idp) VALUES(" . "'" . $skill_id . "'," . $procedure_id . ")";
        return $connector->query($sql) ? true : false;

        pg_close($conn);
    }

    public static function getProcedures() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT mpid, description FROM Mainprocedure ORDER BY mpid");

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

    public static function updateProcedure($id, $description) {
        $connector = new PgConnection();
        $conn = $connector->connect();


        $res = $connector->query("UPDATE MainProcedure SET description =" .
            "'" . $description . "' WHERE mpid = " . $id);

        pg_close($conn);

        return $res ? true : false;
    }
}