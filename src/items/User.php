<?php

include_once '..\PgConnection.php';

class User {
    private static $instance = null;

    private function __construct() {
        // instance init
    }

    private function __clone() {
        // make unclonable the object
    }

    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new User();
        }
        return static::$instance;
    }

    /**
     * store a new user in the database
     *
     * @param $username
     * @param $password
     * @param $email
     * @param $role
     * @param null $name
     * @return bool
     */
    public function save($username, $password, $role, $email, $name = null) {
        $connector = new PgConnection();
        $conn = $connector->connect();

        if($conn == null) {
            return false;
        }

        $res = $this->db_insert($connector, $username, $password, $role, $name, $email);

        pg_close($conn);

        return $res;
    }

    private function db_insert($conn, $username, $password, $role, $name, $email) {
        $sql = "INSERT INTO Client(username, pass, clientname, clientrole, email)
                VALUES(". "'" . $username . "'," . "'" . $password . "'," .
                        "'" . $name . "',". "'" . $role . "'" . ",". "'" . $email . "'" . ")";

        $res = $conn->query($sql);

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;
        return $res;
    }

    /**
     * assign a skill to a maintainer
     * @param $json
     * @return bool
     */
    public function assignSkill($username, $skillname) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $ret = $connector->query("SELECT clientrole, ncompetence FROM Client where username =" . "'" . $username . "'");

        if(pg_num_rows($ret) != 1) {
            pg_close($conn);
            return false;
        }

        $row = pg_fetch_row($ret);

        if($row[0] != 'maintainer') {
            pg_close($conn);
            return false;
        }

        $ncompet = $row[1]+1;

        $ret = $connector->query("SELECT skid FROM Skill WHERE skillname =" . "'" . $skillname . "'");

        if(pg_num_rows($ret) != 1) {
            pg_close($conn);
            return false;
        }
        $skid = pg_fetch_row($ret)[0];

        $sql = "INSERT INTO Holding(username, idskill) VALUES(" . "'" . $username . "'," . $skid . ")";
        $connector->query("UPDATE Client SET ncompetence =" . $ncompet . "WHERE username =" . "'" . $username . "'");

        $res = $connector->query($sql);
        if(pg_affected_rows($res) == 1)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }

    /**
     * remove an user from the system
     * @param $username
     * @return bool
     */
    public function removeUser($username) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $res = $connector->query("DELETE FROM Client WHERE username =" . "'" . $username . "'");

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }

    /**
     * update user s password
     *
     * @param $username
     * @param $password
     * @return bool
     */
    public function updatePassword($username, $password) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $res = $connector->query("UPDATE Client SET pass =" . "'" . $password . "'" . "WHERE username ="
                . "'" . $username . "'");

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }

    /**
     * update user s email
     * @param $username
     * @param $email
     * @return bool
     */
    public function updateEmail($username, $email) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $res = $connector->query("UPDATE Client SET email =" . "'" . $email . "'" . "WHERE username ="
            . "'" . $username . "'");

        if(pg_affected_rows($res) > 0)
            $res = true;
        else
            $res = false;

        pg_close($conn);
        return $res;
    }

    /**
     * get all stored users
     * @return string|null
     */
    public function getUsers() {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return null;
        }

        $res = $connector->query("SELECT username, clientname, pass, email, clientrole FROM Client ORDER BY username");

        if(!$res) {
            pg_close($conn);
            return null;
        }

        $json_string = "[";
        while($row = pg_fetch_row($res)) {
            $json_string = $json_string . "{\n" .'"username":' . '"' . $row[0] . '"' . ",\n" . '"name":' .
                '"' . $row[1] . '"' . ",\n" . '"password":' . '"' . $row[2] . '"' .",\n" . '"email":' . '"' .
                $row[3] . '"' . ",\n" . '"role":' . '"' . $row[4] . '"' ."\n}" . ",\n";
        }
        if(strlen($json_string) > 1) {
            $json_string = substr($json_string, 0, strlen($json_string) - 2);
            $json_string = $json_string . "]";
        } else $json_string = null;

        pg_close($conn);

        return $json_string;
    }

    /**
     * Check if the inserted password is correct for given username
     * @param $username
     * @param $password
     * @return bool
     */
    public function checkPassword($username, $password) {
        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $res = $connector->query("SELECT * FROM Client WHERE pass=" . "'" . $password . "'" .
                "AND username=" . "'" . $username . "'");
        return pg_num_rows($res) == 1;
    }

    public function loadWeekPercentage($week, $activityid) {
        $res = $this->getStartEndDate($week, (
            new DateTime)->format("Y"));
        $start = $res['start_date'];
        $end = $res['end_date'];

        $connector = new PgConnection();
        $conn = $connector->connect();
        if($conn == null) {
            return false;
        }

        $activity_skills = $connector->query("SELECT skid, skillname 
                                                       FROM SMAssignment JOIN Skill ON skid = idskill
                                                        WHERE maid = " . $activityid);
        $maintainers_skills = $connector->query("SELECT C.username, COUNT(C.username) 
                                                         FROM Client C LEFT JOIN Holding H ON H.username = C.username
                                                         LEFT JOIN (SELECT skid
                                                                    FROM Skill S JOIN SMAssignment SM ON SM.idskill = S.skid
                                                                    WHERE SM.maid =" . $activityid . ") S ON skid = H.idskill    
                                                         JOIN SMAssignment SM ON SM.idskill = H.idskill 
                                                         WHERE C.clientrole = 'maintainer'
                                                         GROUP BY C.username
                                                         ORDER BY C.username;");
        $daily_avail = $connector->query("SELECT username, dataavail, percentavailab
                                                    FROM Client NATURAL JOIN DailyAvailability
                                                    WHERE dataavail <=" . "'" . $end . "'" . "
                                                    AND dataavail >=" . "'" . $start . "'" . "
                                                    AND clientrole = 'maintainer';"); // PRENDERE I GIORNI DI UN UTENTE ALLA VOLTA

        if($activity_skills) {
            $skill_num = pg_affected_rows($activity_skills);
            $skills_json = "[";
            while($row = pg_fetch_row($activity_skills)) {
                $skills_json = $skills_json . "{\n" .'"skill":' . '"' . $row[1] . '"'."\n}" . ",\n";
            }
            if(strlen($skills_json) > 1) {
                $skills_json = substr($skills_json, 0, strlen($skills_json) - 2);
                $skills_json = $skills_json . "]";
            } else $skills_json = null;
        }
        else{
            $skill_num = 0;
            $skills_json = null;
        }

        if($daily_avail and $maintainers_skills) {

        }
        return $skills_json;
    }

    private function getStartEndDate($week, $year) {
        $dateTime = new DateTime();
        $dateTime->setISODate($year, $week);
        $result['start_date'] = $dateTime->format('d-m-Y');
        $dateTime->modify('+6 days');
        $result['end_date'] = $dateTime->format('d-m-Y');
        return $result;
    }
}
