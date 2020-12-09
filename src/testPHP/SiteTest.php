<?php


use PHPUnit\Framework\TestCase;
include '..\items\Site.php';

class SiteTest extends TestCase {

    public function testSave() {
        $site = Site::getInstance();
        $res = $site->save("test", "test");
        $this->assertEquals($res, true);

        $res = $site->save("test", "Molding");
        $this->assertEquals($res, true);

        $res = $site->save("Fisciano", "test");
        $this->assertEquals($res, true);

        $res = $site->save("Fisciano", "Molding");
        $this->assertEquals($res, false);

        $res = $site->save("", "Molding");
        $this->assertEquals($res, false);

        $res = $site->save("Fisciano", "");
        $this->assertEquals($res, false);

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("DELETE FROM Site where branch = 'test'");

        pg_close($conn);
    }

    function testGetSites() {
        $site = Site::getInstance();
        $json_string = $site->getSites();
        $expected = file_get_contents("test_files\sites.json");
        $this->assertEquals($expected, $json_string);
    }

    function testUpdateSite() {
        $site = Site::getInstance();
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT branch, department FROM Site where sid = 2");

        $row = pg_fetch_row($res);
        $oldBranch = $row[0];
        $oldDepartment = $row[1];

        $ret = $site->updateSite(2, "test", "test");
        $this->assertEquals($ret, true);

        $ret = $site->updateSite(2, $oldBranch, $oldDepartment);
        $this->assertEquals($ret, true);

        $ret = $site->updateSite(2, "Fisciano", "test");
        $this->assertEquals($ret, true);

        $ret = $site->updateSite(2, "test", "Molding");
        $this->assertEquals($ret, true);

        $ret = $site->updateSite(2, "", "Molding");
        $this->assertEquals($ret, false);

        $ret = $site->updateSite(2, "Fisciano", "");
        $this->assertEquals($ret, false);

        $ret = $site->updateSite(-3, "test", "test");
        $this->assertEquals($ret, false);


    }

    function testRemoveSite(){
        $site = Site::getInstance();
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT branch, department FROM Site where sid = 2");

        $row = pg_fetch_row($res);
        $oldBranch = $row[0];
        $oldDepartment = $row[1];


        $ret = $site->removeSite(2);
        $this->assertEquals($ret, true);

        $ret = $site->removeSite(-3);
        $this->assertEquals($ret, false);

        $ret = $site->save(2, $oldBranch, $oldDepartment);
     

        pg_close($conn);
    }
}
