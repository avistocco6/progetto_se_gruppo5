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
                VALUES(" . "," . "'" . $procedure->description . "'" .
                "'" . $procedure->activity . "'" . ")";

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
}