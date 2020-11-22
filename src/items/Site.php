<?php

include_once '..\PgConnection.php';

class Site {
    private $id;
    private $branch;
    private $department;

    public function __construct($id, $branch, $department) {
        $this->id = $id;
        $this->department = $department;
        $this->branch = $branch;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_branch() {
        return $this->branch;
    }

    public function get_department() {
        return $this->department;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function set_department($department) {
        $this->department = $department;
    }

    public function set_branch($branch) {
        $this->branch = $branch;
    }

    public static function save_from_json($file) {
        $conn = new PgConnection();
        $conn = $conn->connect();

        if($conn == null) {
            //echo '<p style="color:rgb(255,0,0);">Error saving site</p>';
            return false;
        }
        $json_data = file_get_contents($file);
        $site = json_decode($json_data, true);

        if($site == null)
            return false;

        $id = $site['id'];
        $branch = $site['branch'];
        $department = $site['department'];

        $res = Site::db_insert($conn, $id, $department, $branch);

        pg_close($conn);

        return $res;
    }

    private static function db_insert($conn, $id, $department, $branch) {
        $sql = "INSERT INTO Site(sid, branch, departement)
                VALUES(" . $id . "," . "'" . $branch . "'" . "," . "'" . $department . "'" . ")";

        $insert_query = pg_query($conn, $sql);

        if(!$insert_query)
            return false;
        else
            return true;
    }
}