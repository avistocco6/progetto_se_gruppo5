<?php

include_once '..\items\Maintenance.php';

class MaintenanceTest
{
    function test_getByWeek() {
        $json_string = Maintenance::getByWeek(23, 'planned activity');
        file_put_contents("test_files\maintenances.json", $json_string);
    }
    function test_loadActivity() {
        $json_string = Maintenance::loadActivity(1);
        file_put_contents("test_files\selectedActivity.json", $json_string);
    }
    function test_loadWeeks() {
        $json_string = Maintenance::loadWeeks();
        file_put_contents("test_files\weeks.json", $json_string);
    }
    function test_save() {
        $ret = Maintenance::save(1, "test", "11:20:30",
            1, false, 1, 'planned activity');
        return $ret;
    }
}

$test = new MaintenanceTest();

$test->test_getByWeek();
echo "<h1>PLANNED ACTIVITY ON WEEK 23</h1>";
echo file_get_contents("test_files\maintenances.json");

$test->test_loadActivity();
echo "<h1>LOADED ACTIVITY 1</h1>";
echo file_get_contents("test_files\selectedActivity.json");

$test->test_loadWeeks();
echo "<h1>LOADED WEEKS</h1>";
echo file_get_contents("test_files\weeks.json");


echo "<h1>SAVE</h1>";
echo $test->test_save();