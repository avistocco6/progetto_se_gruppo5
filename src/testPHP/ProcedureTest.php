<?php


use PHPUnit\Framework\TestCase;
include_once '..\items\Procedure.php';

class ProcedureTest extends TestCase
{

    public function testSave() {
        $procedure = Procedure::getInstance();
        $res = $procedure->save("testDesc");
        $this->assertEquals($res, true);

        $res = $procedure->save("unscrew the affected part; remove the cables; remove the residues; apply new cables.");
        $this->assertEquals($res, false);  

        $res = $procedure->save("");
        $this->assertEquals($res, false);

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("DELETE FROM MainProcedure where description = 'testDesc'");

        pg_close($conn);
    }
/*
    public function testAddSkill() {
        $res = Procedure::addSkill($json_data);
        $this->assertEquals($res, true);
    }
*/
    function testGetProcedures() {
        $procedure = Procedure::getInstance();
        $json_string = $procedure->getProcedures();
        $expected = file_get_contents("test_files\procedures.json");
        $this->assertEquals($expected, $json_string);
    }

    function testUpdateProcedure() {
        $procedure = Procedure::getInstance();

        $procedure->save("testDesc");

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT mpid FROM MainProcedure
                                    WHERE description = 'testDesc'");

        $n = pg_fetch_row($res)[0];

        $ret = $procedure->updateProcedure($n, "testD");
        $this->assertEquals($ret, true);

        $procedure->removeProcedure($n);

        $ret = $procedure->updateProcedure(2, "unscrew the affected part; remove the cables; remove the residues; apply new cables.");
        $this->assertEquals($ret, false);

        $ret = $procedure->updateProcedure(-3, "testDesc");
        $this->assertEquals($ret, false);

        $ret = $procedure->updateProcedure(2, "");
        $this->assertEquals($ret, false);
    }


    function testRemoveProcedure(){
        $procedure = Procedure::getInstance();
        $procedure->save("testP");

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT mpid FROM MainProcedure
                                    WHERE description = 'testP'");

        $n = pg_fetch_row($res)[0];

        $ret = $procedure->removeProcedure($n);
        $this->assertEquals($ret, true);

        $ret = $procedure->removeProcedure(-3);
        $this->assertEquals($ret, false);
    }

}
