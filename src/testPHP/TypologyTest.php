<?php


use PHPUnit\Framework\TestCase;
include_once '..\items\Typology.php';

class TypologyTest extends TestCase {
    public function testSave() {
        $tp = Typology::getInstance();
        $res = $tp->save("test");
        $this->assertEquals($res, true);

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("DELETE FROM Typology where description = 'test'");

        pg_close($conn);
    }


    function testGetTypologies() {
        $tp = Typology::getInstance();
        $json_string = $tp->getTypologies();
        $expected = file_get_contents('test_files\typologies.json');
        $this->assertEquals($expected, $json_string);
    }

    function testUpdateTypology() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT description FROM Typology where tid = 1");

        $row = pg_fetch_row($res);
        $oldDesc = $row[0];

        $tp = Typology::getInstance();
        $ret = $tp->updateTypology(1, "test");
        $this->assertEquals($ret, true);

        $ret = $tp->updateTypology(1, $oldDesc);
        $this->assertEquals($ret, true);
    }
}
