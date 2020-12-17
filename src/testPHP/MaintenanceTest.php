<?php

//The following test cases are documented in the directory "documenti testing". 
//PHPUnit is the tool used to test.
//Function assertEquals verifies if the desired output is equal to the obtained output.
//Singleton pattern is used.
//These methods are the corresponding methods of the Maintenance class in items package.

use PHPUnit\Framework\TestCase;
include_once '..\items\Maintenance.php';

class MaintenanceTest extends TestCase
{
    function testGetByWeek() {
        $man = Maintenance::getInstance();
        $json_string = $man->getByWeek(12, 'planned activity');
        $expected = file_get_contents("test_files\maintenances.json");
        $this->assertEquals($expected, $json_string);

        $json_string = $man->getByWeek(-3, 'planned activity');
                $this->assertEquals(null, $json_string);


        $json_string = $man->getByWeek(60, 'planned activity');
                $this->assertEquals(null, $json_string);   


        $json_string = $man->getByWeek(12,"");
                $this->assertEquals(null, $json_string);             
    }
    function testLoadActivity() {
        $man = Maintenance::getInstance();
        $json_string = $man->loadActivity(2);
        $expected = file_get_contents("test_files\selectedActivity.json");
        $this->assertEquals($expected, $json_string);

        $json_string = $man->loadActivity(-3);
        $this->assertEquals(null, $json_string);
    }
    function testLoadWeeks() {
        $man = Maintenance::getInstance();
        $json_string = $man->loadWeeks();
        $expected = file_get_contents("test_files\weeks.json");
        $this->assertEquals($expected, $json_string);
    }
    function testSave() {
        $man = Maintenance::getInstance();
        $ret = $man->save(2, "testDesc", "1:00:00",
            12, true, 2, 'planned activity');
        $this->assertEquals($ret, true);
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("DELETE FROM MainActivity where description = 'testDesc'");

        $ret = $man->save(2, "replacement of robot 23 welding cables", "00:30:00",
            23, true, 2, 'planned activity');
        $this->assertEquals($ret, false);

        $ret = $man->save(-3, "testDesc", "1:00:00",
            12,true, 2, 'planned activity');
        $this->assertEquals($ret, false);                        

        $ret = $man->save(2, "testDesc", "-1:00:00",
            12,true, 2, 'planned activity');
        $this->assertEquals($ret, false);

        $ret = $man->save(2, "testDesc", "1:00:00",
            -3,true, 2, 'planned activity');
        $this->assertEquals($ret, false);    

        $ret = $man->save(2, "testDesc", "1:00:00",
            60,true, 2, 'planned activity');
        $this->assertEquals($ret, false); 

        $ret = $man->save(2, "testDesc", "1:00:00",
            12,true, -3, 'planned activity');
        $this->assertEquals($ret, false);

        $ret = $man->save(2, "testDesc", "1:00:00",
            12,true, -3, "");
        $this->assertEquals($ret, false);

    }
    function testUpdate() {


        $man = Maintenance::getInstance();

        $ret = $man->save(2, "testDesc", "1:00:00",
            12, true, 2, 'planned activity');

        $connector = new PgConnection();
        $conn = $connector->connect();
        $res = $connector->query("SELECT maid FROM MainActivity
                                    WHERE description = 'testDesc'");

        $n = pg_fetch_row($res)[0];

        $ret = $man->updateActivity($n, "test", 1, 1,
            "11:11:11", 1, false, 'planned activity');
        $this->assertEquals($ret, true);

        $man->removeActivity($n);

        $ret = $man->updateActivity(2, "replacement of robot 23 welding cables", 2, 2,
            "00:30:00", 23, true, 'planned activity');
        $this->assertEquals($ret, false);

        $ret = $man->updateActivity(2, "testDesc", 2, 2,
            "1:00:00", 12, true, "");
        $this->assertEquals($ret, false); 

        $ret = $man->updateActivity(-3, "testDesc", 2, 2,
            "1:00:00", 12, true, 'planned activity');
        $this->assertEquals($ret, false);     

        $ret = $man->updateActivity(2, "testDesc", -3, 2,
            "1:00:00", 12, true, 'planned activity');
        $this->assertEquals($ret, false);  

        $ret = $man->updateActivity(2, "testDesc", 2, 2,
            "-1:00:00", 12, true, 'planned activity');
        $this->assertEquals($ret, false);   

        $ret = $man->updateActivity(2, "testDesc", 2, 2,
            "1:00:00", -3, true, 'planned activity');
        $this->assertEquals($ret, false); 

        $ret = $man->updateActivity(2, "testDesc", 2, 2,
            "1:00:00", 60, true, 'planned activity');
        $this->assertEquals($ret, false);

        $ret = $man->updateActivity(2, "testDesc", 2, -3,
            "1:00:00", 12, true, 'planned activity');
        $this->assertEquals($ret, false);

    }


    function testRemove(){

        $man = Maintenance::getInstance();
        $ret = $man->save(2, "testDesc", "1:00:00",
            12, true, 2, 'planned activity');

        $connector = new PgConnection();
        $conn = $connector->connect();
        $res = $connector->query("SELECT maid FROM MainActivity
                                    WHERE description = 'testDesc'");

        $n = pg_fetch_row($res)[0];


        $ret = $man->removeActivity($n);
        $this->assertEquals($ret, true);        

        $ret = $man->removeActivity(-3);
        $this->assertEquals($ret, false); 

    }
}

