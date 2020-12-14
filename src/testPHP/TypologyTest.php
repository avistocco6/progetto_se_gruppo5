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

        $res = pg_query("DELETE FROM Typology where description = 'test'");

        $res = $tp->save("Electric");
        $this->assertEquals($res, false);

        $res = $tp->save("");
        $this->assertEquals($res, false);

        pg_close($conn);
    }


    function testGetTypologies() {
        $tp = Typology::getInstance();
        $json_string = $tp->getTypologies();
        $expected = file_get_contents('test_files\typologies.json');
        $this->assertEquals($expected, $json_string);
    }

    function testUpdateTypology() {
        $tp = Typology::getInstance();
        $tp->save("testT");

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT tid FROM Typology
                                    WHERE description = 'testT'");

        $n = pg_fetch_row($res)[0];

        $ret = $tp->updateTypology($n, "testDesc");
        $this->assertEquals($ret, true);

        $tp->removeTypology($n);

        $ret = $tp->updateTypology(-3, "testDesc");
        $this->assertEquals($ret, false);

        $ret = $tp->updateTypology($n, "Electric");
        $this->assertEquals($ret, false);

        $ret = $tp->updateTypology($n, "");
        $this->assertEquals($ret, false);

    }

    function testRemoveTypology() {
        $tp = Typology::getInstance();
        $tp->save("testT");

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT tid FROM Typology
                                    WHERE description = 'testT'");

        $n = pg_fetch_row($res)[0];

        $ret = $tp->removeTypology($n);
        $this->assertEquals($ret, true);

        $ret = $tp->removeTypology(-5);
        $this->assertEquals($ret, false);

    }
}
