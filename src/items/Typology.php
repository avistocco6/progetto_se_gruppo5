<?php

include_once '..\PgConnection.php';

class Typology {
    private static $instance = null;

    private function __construct() {
        // instance init
    }

    private function __clone() {
        // make unclonable the object
    }

    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new Typology();
        }
        return static::$instance;
    }

    /**
     * store a new typology
     * @param $description
     * @return bool
     */
    public function save($description) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }
        if(!$this->checkTypology($description, $connector))
            return false;

        $res = $this->dbInsert($connector, $description);

        pg_close($conn);

        return $res;
    }

    private function checkTypology($desc, $connector) {
        if($desc == "")
            return false;
        $res = $connector->query("SELECT * FROM Typology WHERE description = "
            . "'" . $desc . "'");

        if(pg_num_rows($res) > 0)
            return false;

        return true;
    }

    private function dbInsert($conn, $description) {
        $sql = "INSERT INTO Typology(description)
                VALUES(". "'". $description . "'" . ")";

        $res = $conn->query($sql);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        return $res;
    }

    /**
     * get all stored typologies
     * @return string|null
     */
    public function getTypologies() {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return null;
        }

        $res = $connector->query("SELECT * FROM Typology ORDER BY tid");

        if(!$res) {
            pg_close($conn);
            return null;
        }
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

    /**
     * update a stored typology
     * @param $id
     * @param $description
     * @return bool
     */
    public function updateTypology($id, $description) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }
        if(!$this->checkTypology($description, $connector) or $id < 1)
            return false;

        $res = $connector->query("UPDATE Typology SET description =" .
            "'" . $description . "' WHERE tid = " . $id);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }

    /**
     * delete a stored typology by id
     * @param $id
     * @return bool
     */
    public function removeTypology($id) {
        if($id < 1)
            return false;
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $res = $connector->query("DELETE FROM Typology WHERE tid =" . $id);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }
}