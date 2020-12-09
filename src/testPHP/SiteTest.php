<?php


use PHPUnit\Framework\TestCase;
include '..\items\Site.php';

class SiteTest extends TestCase {

    public function testSave() {
        $res = Site::save("test", "test");
        $this->assertEquals($res, true);

        $res = Site::save("test", "Molding");
        $this->assertEquals($res, true);

        $res = Site::save("Fisciano", "test");
        $this->assertEquals($res, true);

        $res = Site::save("Fisciano", "Molding");
        $this->assertEquals($res, false);

        $res = Site::save("", "Molding");
        $this->assertEquals($res, false);

        $res = Site::save("Fisciano", "");
        $this->assertEquals($res, false);

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("DELETE FROM Site where branch = 'test'");



        pg_close($conn);
    }

    function testGetSites() {
        $json_string = Site::getSites();
        $expected = file_get_contents("test_files\sites.json");
        $this->assertEquals($expected, $json_string);
    }

    function testUpdateSite() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT branch, department FROM Site where sid = 2");

        $row = pg_fetch_row($res);
        $oldBranch = $row[0];
        $oldDepartment = $row[1];

        $ret = Site::updateSite(2, "test", "test");
        $this->assertEquals($ret, true);

        $ret = Site::updateSite(2, $oldBranch, $oldDepartment);
        $this->assertEquals($ret, true);

        $ret = Site::updateSite(2, "Fisciano", "test");
        $this->assertEquals($ret, true);

        $ret = Site::updateSite(2, "test", "Molding");
        $this->assertEquals($ret, true);

        $ret = Site::updateSite(2, "", "Molding");
        $this->assertEquals($ret, false);

        $ret = Site::updateSite(2, "Fisciano", "");
        $this->assertEquals($ret, false);

        $ret = Site::updateSite(-3, "test", "test");
        $this->assertEquals($ret, false);


    }


    function testRemoveSite(){
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT branch, department FROM Site where sid = 2");

        $row = pg_fetch_row($res);
        $oldBranch = $row[0];
        $oldDepartment = $row[1];


        $ret = Site::removeSite(2);
        $this->assertEquals($ret, true);

        $ret = Site::removeSite(-3);
        $this->assertEquals($ret, false);

        $ret = Site::save(2, $oldBranch, $oldDepartment);
     

        pg_close($conn);
    }
}
