<?php

include_once '..\PgConnection.php';

class Maintenance {
    private static  $instance = null;

    private function __construct() {
        // instance init
    }

    private function __clone() {
        // make unclonable the object
    }

    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new Maintenance();
        }
        return static::$instance;
    }

    /**
     *
     * save a maintenance in the database
     *
     * @param $idsite
     * @param $description
     * @param $estimatedtime
     * @param $week
     * @param $interruptible
     * @param $idtypology
     * @param $mtype
     * @return bool true if correctly saved, false if not
     */
    public function save($idsite, $description, $estimatedtime, $week, $interruptible, $idtypology, $mtype) {
        if($idsite <= 0 || $week <= 0 ||
            $description == "" || $estimatedtime == "" ||
            $idtypology <= 0 || $mtype == "")
            return false;

        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = $this->db_insert($connector, $idsite, $description, $estimatedtime, $week, $interruptible, $idtypology, $mtype);

        pg_close($conn);

        return $res;
    }

    private function db_insert($conn, $idsite, $description, $estimatedtime, $week, $interruptible, $idtypology, $mtype) {
        $interruptible = $interruptible ? 'true' : 'false';
        $sql = "INSERT INTO MainActivity(description, estimatedtime, interruptible, week, idtypology, idsite, mtype)
                VALUES(" . "'" . $description . "'" . "," . "'" .$estimatedtime . "'" .
                    "," . $interruptible . "," . $week  . "," . $idtypology . "," . $idsite . ",'" . $mtype . "')";

        $res = $conn->query($sql);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        return $res;
    }

    /**
     * load all maintenances planned on a selected week
     * @param $week
     * @param $type
     * @return string|null
     */
    public function getByWeek($week, $type) {
      $connector = new PgConnection();
      $conn = $connector->connect();

      $res = pg_query("SELECT maid, branch, department, Typology.description, estimatedtime
                      FROM MainActivity, Site, Typology
                      WHERE idtypology = tid AND idsite = sid AND mtype = '" . $type .
                      "' AND week = " . $week . "ORDER BY maid;");

      if(!$res) return null;

      $json_string = "[";
      while($row = pg_fetch_row($res)) {
          $json_string = $json_string . "{\n" .'"id":' . $row[0] . ",\n" . '"area":' .
              '"' . $row[1] . " - " . $row[2] . '"' . ",\n" . '"type":' . '"' . $row[3] . '"' .
              ",\n" . '"estimated_time":' . '"' . $row[4] . '"' . "\n}" . ",\n";
      }
      if(strlen($json_string) > 1) {
          $json_string = substr($json_string, 0, strlen($json_string) - 2);
          $json_string = $json_string . "]";
      } else $json_string = null;
      pg_close($conn);

      return $json_string;
  }

    /**
     * load a maintenance activity by id
     * @param $id
     * @return string|null
     */
  public function loadActivity($id) {
      $connector = new PgConnection();
      $conn = $connector->connect();

      $activity = $connector->query("SELECT maid, week, MA.description, workspacenotes, branch, 
                                            department, estimatedtime, typology.description
                      FROM MainActivity AS MA, Site, Typology
                      WHERE maid ="  . $id . "and idsite = sid and idtypology = tid");

      $skills = $connector->query("SELECT skid, skillname
                      FROM Skill, MainActivity AS MA, SMAssignment AS Assign
                      WHERE idskill = skid and MA.maid = Assign.maid and
                            MA.maid =" . $id .
                      "ORDER BY skid");

      if(!$activity) return null;

      if(!$skills) {
          $skills_string = '[]';
      }
      else {
        $skills_string = "[";
        while ($row = pg_fetch_row($skills)) {
            $skills_string = $skills_string . "{" . '"id":' . $row[0] . ", " . '"name":' .
                '"' . $row[1] . '"' . "}" . ", ";
        }
        if(strlen($skills_string) > 1) {
            $skills_string = substr($skills_string, 0, strlen($skills_string) - 2);
            $skills_string = $skills_string . "]";
        } else $skills_string = '[]';
      };
      $row = pg_fetch_row($activity);
      $json_string = '{"id":' . $row[0] . ', "week":' .
            $row[1] . ', "description":' . '"' . $row[2] . '"' .
          ', "workspaceNotes":' . '"' . $row[3] . '"' . ', "skills": ' . $skills_string .
          ',"site":' . '"'. $row[4] . "-" . $row[5] . '", "time":' . '"' . $row[6] . '", "typology":'
          . '"' . $row[7] . '"'. "}";

      pg_close($conn);

      return $json_string;
  }

    /**
     * load all weeks that have maintenances planned
     * @return string|null
     */
  public function loadWeeks() {
      $connector = new PgConnection();
      $conn = $connector->connect();


      $res = $connector->query("SELECT week
                      FROM MainActivity
                      WHERE mtype = 'planned activity'
                      GROUP BY week");

      if(!$res) return null;

      $json_string = "[";
      while($row = pg_fetch_row($res)) {
          $json_string = $json_string . "{\n" .'"week":' . $row[0] . "\n}". ",\n";
      }
      if(strlen($json_string) > 1) {
          $json_string = substr($json_string, 0, strlen($json_string) - 2);
          $json_string = $json_string . "]";
      } else $json_string = null;
      pg_close($conn);

      return $json_string;
  }

    /**
     * update a maintenance activity
     * @param $maid
     * @param $description
     * @param $idsite
     * @param $idtypology
     * @param $estimatedtime
     * @param $week
     * @param $interruptible
     * @param $mtype
     * @return bool
     */
    public function updateActivity($maid, $description, $idsite, $idtypology, $estimatedtime, $week, $interruptible, $mtype) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        $interruptible = $interruptible ? 'true' : 'false';
        $res = $connector->query("UPDATE MainActivity SET description = " .
            "'" . $description . "', idsite = " . "'" . $idsite . "', idtypology = " . "'" . $idtypology ."', estimatedtime = '"
            . $estimatedtime . "', week = " . "'" . $week . "', interruptible = " . "'" . $interruptible ."',"
            . " mtype = '" . $mtype . "'" .  "WHERE maid = " . $maid);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }

    /**
     * delete a stored maintenance activity by id
     * @param $maid
     * @return bool
     */
    public function removeActivity($maid) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("DELETE FROM MainActivity WHERE maid =" . $maid);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }
}
