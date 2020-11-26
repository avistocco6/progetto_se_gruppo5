<?php

include_once '..\PgConnection.php';

class Procedure {
    private $description;
    private $smp;
    private $activity;

    public function __construct($description, $activity, $smp = null) {
        $this->description = $description;
        $this->activity = $activity;
        $this->smp = $smp;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getSmp() {
        return file_get_contents($this->smp);
    }

    public function setSmp($smp) {
        $this->smp = $smp;
    }

    public function getActivity() {
        return $this->activity;
    }

    public function setActivity($activity) {
        $this->activity = $activity;
    }

    public static function save($json) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            //echo '<p style="color:rgb(255,0,0);">Error saving material</p>';
            return false;
        }

        $procedure = self::create_from_json($json);

        if($procedure == null) return false;

        $res = self::db_insert($connector, $procedure);

        pg_close($conn);

        return $res;
    }

    private static function db_insert($conn, $procedure) {
        $sql = "INSERT INTO MainProcedure(description, idactivity)
                VALUES(" . "'" . $procedure->description . "'," .
                 $procedure->activity . ")";

        return $conn->query($sql) ? true : false;
    }

    private static function create_from_json($json) {
        $material = json_decode($json, true);

        if($material == null)
            return null;

        $description = $material['description'];
        $activity = $material['activity_id'];

        return new Procedure($description, $activity);
    }

    public static function addSkill($json) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $assign = json_decode($json, true);

        $skill_id = $assign['skill_id'];
        $procedure_id = $assign['procedure_id'];

        $sql = "INSERT INTO SPAssignment(ids, idp) VALUES(" . "'" . $skill_id . "'," . $procedure_id . ")";
        return $connector->query($sql) ? true : false;

        pg_close($conn);
    }

    public static function get_procedures() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("SELECT mpid, description FROM Mainprocedure");

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
}