<?php

include_once '..\items\Maintenance.php';

class MaintenanceTest
{
    function test_getByWeek() {
        $json = '{ "week": 23, "type": "planned activity"}';
        $json_string = Maintenance::getByWeek($json);
        file_put_contents("test_files\maintenances.json", $json_string);
    }
}

$test = new MaintenanceTest();

$test->test_getByWeek();
echo "<h1>PLANNED ACTIVITY ON WEEK 23</h1>";
echo file_get_contents("test_files\maintenances.json");