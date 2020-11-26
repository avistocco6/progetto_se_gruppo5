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

    public static  function getByWeek($json) {
      $connector = new PgConnection();
      $conn = $connector->connect();

      $week = json_decode($json);
      $res = pg_query("SELECT maid, branch, department, Typology.description, estimatedtime
                      FROM MainActivity, Site, Typology
                      WHERE idtypology = tid AND idsite = sid AND mtype = 'planned activity'
                      AND week = week;");

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
}
