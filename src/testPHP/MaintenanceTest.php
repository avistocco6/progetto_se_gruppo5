<?php


use PHPUnit\Framework\TestCase;
include_once '..\items\Maintenance.php';

class MaintenanceTest extends TestCase
{
    function testGetByWeek() {
        $man = Maintenance::getInstance();
        $json_string = $man->getByWeek(23, 'planned activity');
        $expected = file_get_contents("test_files\maintenances.json");
        $this->assertEquals($expected, $json_string);
    }
    function testLoadActivity() {
        $man = Maintenance::getInstance();
        $json_string = $man->loadActivity(1);
        $expected = file_get_contents("test_files\selectedActivity.json");
        $this->assertEquals($expected, $json_string);
    }
    function testLoadWeeks() {
        $man = Maintenance::getInstance();
        $json_string = $man->loadWeeks();
        $expected = file_get_contents("test_files\weeks.json");
        $this->assertEquals($expected, $json_string);
    }
    function testSave() {
        $man = Maintenance::getInstance();
        $ret = $man->save(1, "test", "11:20:30",
            1, false, 1, 'planned activity');
        $this->assertEquals($ret, true);
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("DELETE FROM MainActivity where description = 'test'");

        pg_close($conn);
    }
    function testUpdate() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("SELECT description, idsite, idtypology,
                    estimatedtime, week, interruptible, mtype FROM MainActivity where maid = 1");

        $row = pg_fetch_row($res);
        $oldDesc = $row[0];
        $idSite = $row[1];
        $idTyp = $row[2];
        $estTime = $row[3];
        $week = $row[4];
        $interruptible = $row[5];
        $mtype = $row[6];

        $man = Maintenance::getInstance();
        $ret = $man->updateActivity(1, "test", 1, 1,
            "11:11:11", 1, false, 'planned activity');
        $this->assertEquals($ret, true);

        $man = Maintenance::getInstance();
        $ret = $man->updateActivity(1, $oldDesc, $idSite, $idTyp,
            $estTime, $week, $interruptible, $mtype);
        $this->assertEquals($ret, true);
    }
}
