<?php

include_once '..\PgConnection.php';

class Activity {
    private $idsite;
    private $idtypology;
    private $description;
    private $estimatedtime;
    private $interruptible;
    private $week;

    public function __construct($idsite, $idtypology, $description, $estimatedtime, $interruptible, $week) {
        $this->$idsite = $idsite; 
        $this->$idtypology = $typology;
        $this->description = $description; 
        $this->$estimatedtime = $estimatedtime;
        $this->$interruptible = $interruptible; 
        $this->$week = $week;
    }


    public function get_site() {
        return $this->$idsite;
    }

    public function get_typology() {
        return $this->$idtypology;
    }

    public function get_description() {
        return $this->$description;
    }

    public function get_estimatedtime() {
        return $this->$estimatedtime;
    }

    public function get_interruptible() {
        return $this->$interruptible;
    }

    public function get_week() {
        return $this->$week;
    }
    public function set_site($idsite) {
        $this->$idsite;
    }
     public function set_typology($idtypology) {
        $this->$idtypology;
    }

    public function set_description($description) {
        $this->$description;
    }

    public function set_estimatedtime($estimatedtime) {
        $this->$estimatedtime;
    }

    public function set_interruptible($interruptible) {
        $this->$interruptible;
    }

    public function set_week($week) {
        $this->$week;
    }

    public static function save($json) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            //echo '<p style="color:rgb(255,0,0);">Error saving views</p>';
            return false;
        }

        $activity = self::create_from_json($json);

        if($activity == null) return false;

        $res = self::db_insert($connector, $activity);

        pg_close($conn);

        return $res;
    }

    private static function create_from_json($json) {
        $activity = json_decode($json, true);

        if($activity == null)
            return null;
        $description = $activity['description'];
        $idsite = $activity['idsite'];
        $idtypology = $activity['idtypology'];
        $estimatedtime = $activity['estimatedtime'];
        $week = $activity['week'];
        $interruptible = $activity['interruptible'];


        return new Activity($maid, $description, $idsite, $idtypology, $estimatedtime, $week, $interruptible);
    }

    private static function db_insert($conn, $activity) {
        $sql = "INSERT INTO MainActivity(description, estimatedtime, interruptible, week, idtypology, idsite)
                VALUES(" . "'" . $activity->description . "'" . "," . "'" . $activity->estimatedtime . "'". "," . "'" . $activity->interruptible . "'". "," . "'" . $activity->week . "'". "," . "'" . $activity->idtypology. "," . "'" . $activity->idsite . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    public static function get_activities() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT * FROM MainActivity ORDER BY week");

        if(!$res) return false;

        $json_string = "[";
        while($row = pg_fetch_row($res)) {
            $json_string = $json_string . "{\n" . '"description":' .
                '"' . $row[0] . '"' . ",\n" . '"estimatedtime":' .
                '"' . $row[1] . '"' .",\n" . '"interruptible":' .
                '"' . $row[2] . '"' .",\n" . '"week":' .
                '"' . $row[3] . '"' .",\n" . '"idtypology":' .
                '"' . $row[4] . '"' .",\n" . '"idsite":' .
                '"' . "\n}" . ",\n";
        }
        if(strlen($json_string) > 1) {
            $json_string = substr($json_string, 0, strlen($json_string) - 2);
            $json_string = $json_string . "]";
        } else $json_string = null;

        pg_close($conn);

        return $json_string;
    }

    public static function updateActivity($json) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $activity = json_decode($json, true);
        $maid = $activity['maid'];
        $description = $activity['description'];
        $idsite = $activity['idsite'];
        $idtypology = $activity['idtypology'];
        $estimatedtime = $activity['estimatedtime'];
        $week = $activity['week'];
        $interruptible = $activity['interruptible'];

        $res = pg_query("UPDATE MainActivity SET description = " .
            "'" . $description . "', idsite = " . "'" . $idsite . "', idtypology = " . "'" . $idtypology "', estimatedtime = " . "'" . $estimatedtime "', week = " . "'" . $week "', interruptible = " . "'" . $interruptible ."'" .  "WHERE maid = " . $maid);

        pg_close($conn);
        return $res ? true : false;
    }
}