<?php


use PHPUnit\Framework\TestCase;
include_once '..\items\Maintenance.php';

class MaintenanceTest extends TestCase
{
    function testGetByWeek() {
        $json_string = Maintenance::getByWeek(23, 'planned activity');
        $expected = file_get_contents("test_files\maintenances.json");
        $this->assertEquals($expected, $json_string);
    }
    function testLoadActivity() {
        $json_string = Maintenance::loadActivity(1);
        $expected = file_get_contents("test_files\selectedActivity.json");
        $this->assertEquals($expected, $json_string);
    }
    function testLoadWeeks() {
        $json_string = Maintenance::loadWeeks();
        $expected = file_get_contents("test_files\weeks.json");
        $this->assertEquals($expected, $json_string);
    }
    function testSave() {
        $ret = Maintenance::save(1, "test", "11:20:30",
            1, false, 1, 'planned activity');
        $this->assertEquals($ret, true);
    }
    function testUpdate() {
        $ret = Maintenance::updateActivity(1, "test", 1, 1,
            "11:11:11", 1, false, 'planned activity');
        $this->assertEquals($ret, true);
    }
}
