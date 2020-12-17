<?php

//The following test cases are documented in the directory "documenti testing". 
//PHPUnit is the tool used to test.
//Function assertEquals verifies if the desired output is equal to the obtained output.
//Singleton pattern is used.
//These methods are the corresponding methods of the Site class in items package.
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

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("DELETE FROM Site where branch = 'test' OR department = 'test'");


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
        $site->save("testS", "testS");

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT sid FROM Site
                                    WHERE branch = 'testS'");

        $n = pg_fetch_row($res)[0];

        $ret = $site->updateSite($n, "test", "test");
        $this->assertEquals($ret, true);


        $ret = $site->updateSite($n, "Fisciano", "test");
        $this->assertEquals($ret, true);

        $ret = $site->updateSite($n, "test", "Molding");
        $this->assertEquals($ret, true);

        $ret = $site->updateSite($n, "", "Molding");
        $this->assertEquals($ret, false);

        $ret = $site->updateSite($n, "Fisciano", "");
        $this->assertEquals($ret, false);

        $ret = $site->updateSite(-3, "test", "test");
        $this->assertEquals($ret, false);

        $site->removeSite($n);
    }

    function testRemoveSite(){
        $site = Site::getInstance();
        $site->save("test", "test");

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT sid FROM Site
                                    WHERE branch = 'test'");

        $n = pg_fetch_row($res)[0];


        $ret = $site->removeSite($n);
        $this->assertEquals($ret, true);

        $ret = $site->removeSite(-3);
        $this->assertEquals($ret, false);

    }
}
