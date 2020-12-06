<?php

include_once '..\PgConnection.php';

class Material {
    private static $instance = null;

    private function __construct() {
        // instance init
    }

    private function __clone() {
        // make unclonable the object
    }

    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new Material();
        }
        return static::$instance;
    }

    /**
     * save a new material
     * @param $name
     * @param null $activity
     * @return bool
     */
    public function save($name, $activity = null) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = $this->dbInsert($connector, $name, $activity);

        pg_close($conn);

        return $res;
    }

    private function dbInsert($conn, $name, $activity) {
        if($activity != null)
            $sql = "INSERT INTO Material(matname, idactivity)
                    VALUES(" . "'" . $name . "'," . $activity . ")";
        else
            $sql = "INSERT INTO Material(matname)
                    VALUES(" . "'" . $name . "'" . ")";

        return $conn->query($sql) ? true : false;
    }

    /**
     * get all materials
     * @return string|null
     */
    public function getMaterials() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return null;
        }

        $res = $connector->query("SELECT mid, matname FROM Material ORDER BY mid");

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
     * update a material
     * @param $id
     * @param $name
     * @return bool
     */
    public function updateMaterial($id, $name) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = $connector->query("UPDATE Material SET matname =" .
                        "'" . $name . "' WHERE mid = " . $id);

        pg_close($conn);

        return $res ? true : false;
    }

    /**
     * delete a stored material by id
     * @param $id
     * @return bool
     */
    public function removeMaterial($id) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = $connector->query("DELETE FROM Material WHERE mid =" . $mid);

        pg_close($conn);
        return $res ? true : false;
    }
}
