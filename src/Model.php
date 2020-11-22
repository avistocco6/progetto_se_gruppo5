<?php

include_once 'PgConnection.php';

function get_skills() {
    $connector = new PgConnection();
    $conn = $connector->connect();

    $res = pg_query("SELECT * FROM Skill");

    if(!$res) return false;

    $json_string = "[";
    while($row = pg_fetch_row($res)) {
        $json_string = $json_string . "{\n" .'"id":' . $row[0] . ",\n" . '"name":' .
                '"' . $row[1] . '"' . "\n}" . ",\n";
    }
    $json_string = substr($json_string, 0, strlen($json_string)-2);
    $json_string = $json_string . "]";

    pg_close($conn);

    return $json_string;
}

function get_sites() {
    $connector = new PgConnection();
    $conn = $connector->connect();

    $res = pg_query("SELECT * FROM Site");

    if(!$res) return false;

    $json_string = "[";
    while($row = pg_fetch_row($res)) {
        $json_string = $json_string . "{\n" .'"id":' . $row[0] . ",\n" . '"factory":' .
            '"' . $row[1] . '"' . ",\n" . '"factory":' .
            '"' . $row[2] . '"' . "\n}" . ",\n";
    }
    $json_string = substr($json_string, 0, strlen($json_string)-2);
    $json_string = $json_string . "]";

    pg_close($conn);

    return $json_string;
}

function get_typologies() {
    $connector = new PgConnection();
    $conn = $connector->connect();

    $res = pg_query("SELECT * FROM Typology");

    if(!$res) return false;

    $json_string = "[";
    while($row = pg_fetch_row($res)) {
        $json_string = $json_string . "{\n" .'"id":' . $row[0] . ",\n" . '"description":' .
            '"' . $row[1] . '"' . "\n}" . ",\n";
    }
    $json_string = substr($json_string, 0, strlen($json_string)-2);
    $json_string = $json_string . "]";

    pg_close($conn);

    return $json_string;
}

function get_materials() {
    $connector = new PgConnection();
    $conn = $connector->connect();

    $res = pg_query("SELECT mid, name FROM Material");

    if(!$res) return false;

    $json_string = "[";
    while($row = pg_fetch_row($res)) {
        $json_string = $json_string . "{\n" .'"id":' . $row[0] . ",\n" . '"name":' .
            '"' . $row[1] . '"' . "\n}" . ",\n";
    }
    $json_string = substr($json_string, 0, strlen($json_string)-2);
    $json_string = $json_string . "]";

    pg_close($conn);

    return $json_string;
}
?>