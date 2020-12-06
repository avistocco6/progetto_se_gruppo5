<?php

include_once '..\PgConnection.php';

class Site {
    private static $instance = null;

    private function __construct() {
        // instance init
    }

    private function __clone() {
        // make unclonable the object
    }

    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new Site();
        }
        return static::$instance;
    }

    /**
     * store a new site
     * @param $branch
     * @param $department
     * @return bool
     */
    public function save($branch, $department) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        if($conn == null) {
            return false;
        }

        $res = $this->dbInsert($connector, $branch, $department);

        pg_close($conn);

        return $res;
    }


    private function dbInsert($conn, $branch, $department) {
        $sql = "INSERT INTO Site(branch, department)
                VALUES(" . "'" . $branch . "'" . "," . "'" . $department . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    /**
     * get all stored sites
     * @return string|null
     */
    public function getSites() {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return null;
        }

        $res = $connector->query("SELECT * FROM Site ORDER BY sid");

        if(!$res) {
            pg_close($conn);
            return null;
        }
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

    /**
     * update a stored site
     * @param $id
     * @param $branch
     * @param $department
     * @return bool
     */
    public function updateSite($id, $branch, $department) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $res = $connector->query("UPDATE Site SET branch = " .
            "'" . $branch . "', department = " . "'" . $department ."'" . "WHERE sid = " . $id);

        pg_close($conn);
        return $res ? true : false;
    }

    /**
     * delete a stored Site by id
     * @param $id
     * @return bool
     */
    public function removeSite($id) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("DELETE FROM Site WHERE sid =" . $id);

        pg_close($conn);
        return $res ? true : false;
    }
}