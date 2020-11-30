<?php

include_once '..\PgConnection.php';

class Maintenance {
    private $description;
    private $estimatedtime;
    private $interruptible;
    private $EWO;
    private $week;
    private $workspacenotes;
    private $maintainer;
    private $typology;
    private $site;

    public function __construct($site, $description, $estimatedtime, $week, $interruptible = false, $EWO = false, $workspacenotes = null, $maintainer = null, $typology = null) {
      $this->description = $description;
      $this->estimatedtime = $estimatedtime;
      $this->workspacenotes = $workspacenotes;
      $this->week = $week;
      $this->EWO = $EWO;
      $this->interruptible = $interruptible;
      $this->typology = $typology;
      $this->site = $site;
    }

    public static  function getByWeek($week, $type) {
      $connector = new PgConnection();
      $conn = $connector->connect();

      $res = pg_query("SELECT maid, branch, department, Typology.description, estimatedtime
                      FROM MainActivity, Site, Typology
                      WHERE idtypology = tid AND idsite = sid AND mtype = '" . $type .
                      "' AND week = " . $week . "ORDER BY maid;");

      if(!$res) return false;

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

  public static function loadActivity($id) {
      $connector = new PgConnection();
      $conn = $connector->connect();

      $activity = pg_query("SELECT maid, week, description, workspacenotes
                      FROM MainActivity
                      WHERE maid ="  . $id);

      $skills = pg_query("SELECT skid, skillname
                      FROM Skill, MainActivity AS MA, SMAssignment AS Assign
                      WHERE idskill = skid and MA.maid = Assign.maid and
                            MA.maid =" . $id .
                      "ORDER BY skid");

      if(!$activity) return false;

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
          ', "workspaceNotes":' . '"' . $row[3] . '"' . ', "skills": ' . $skills_string . "}";

      pg_close($conn);

      return $json_string;
  }

  public static function loadWeeks() {
      $connector = new PgConnection();
      $conn = $connector->connect();


      $res = pg_query("SELECT week
                      FROM MainActivity
                      WHERE mtype = 'planned activity'
                      GROUP BY week");

      if(!$res) return false;

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

    public static function updateActivity($maid, $description, $idsite, $idtypology, $estimatedtime, $week, $interruptible) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("UPDATE MainActivity SET description = " .
            "'" . $description . "', idsite = " . "'" . $idsite . "', idtypology = " . "'" . $idtypology ."', estimatedtime = '"
            . $estimatedtime . "', week = " . "'" . $week . "', interruptible = " . "'" . $interruptible ."'" .  "WHERE maid = " . $maid);

        pg_close($conn);
        return $res ? true : false;
    }
}
