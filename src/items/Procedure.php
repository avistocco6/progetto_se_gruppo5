<?php

include_once '..\PgConnection.php';

class Procedure {
    private static $instance = null;

    private function __construct() {
        // instance init
    }

    private function __clone() {
        // make unclonable the object
    }

    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new Procedure();
        }
        return static::$instance;
    }

    /**
     * save new procedure
     * @param $description
     * @return bool
     */
    public function save($description) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = $this->dbInsert($connector, $description);

        pg_close($conn);

        return $res;
    }

    private function dbInsert($conn, $description) {
        $sql = "INSERT INTO MainProcedure(description)
                VALUES(" . "'" . $description . "')";

        $res = $conn->query($sql);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        return $res;
    }

    /**
     * assign a skill to a procedure
     * @param $skill_id
     * @param $procedure_id
     * @return bool
     */
    public function addSkill($skill_id, $procedure_id) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $sql = "INSERT INTO SPAssignment(ids, idp) VALUES(" . "'" . $skill_id . "'," . $procedure_id . ")";
        $res = $connector->query($sql);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }

    /**
     * get all stored procedures
     * @return string|null
     */
    public function getProcedures() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return null;
        }

        $res = $connector->query("SELECT mpid, description FROM Mainprocedure ORDER BY mpid");

        if(!$res) {
            pg_close($conn);
            return null;
        }
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

    /**
     * update a stored procedure
     * @param $id
     * @param $description
     * @return bool
     */
    public function updateProcedure($id, $description) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = $connector->query("UPDATE MainProcedure SET description =" .
            "'" . $description . "' WHERE mpid = " . $id);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }

    /**
     * delete a stored Procedure by id
     * @param $id
     * @return bool
     */
    public function removeProcedure($id) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = $connector->query("DELETE FROM Procedure WHERE pid =" . $id);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }
}