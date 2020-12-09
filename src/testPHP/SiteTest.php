<?php


use PHPUnit\Framework\TestCase;
include '..\items\Site.php';

class SiteTest extends TestCase {

    public function testSave() {
        $res = Site::save("test", "test");
        $this->assertEquals($res, true);

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

        $res = $connector->query("SELECT branch, department FROM Site where sid = 1");

        $row = pg_fetch_row($res);
        $oldBranch = $row[0];
        $oldDepartment = $row[1];

        $ret = Site::updateSite(1, "test", "test");
        $this->assertEquals($ret, true);

        $ret = Site::updateSite(1, $oldBranch, $oldDepartment);
        $this->assertEquals($ret, true);
    }
}
