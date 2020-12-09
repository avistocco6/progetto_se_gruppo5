<?php


use PHPUnit\Framework\TestCase;
include_once '..\items\Procedure.php';

class ProcedureTest extends TestCase
{

    public function testSave() {
        $res = Procedure::save("testDesc");
        $this->assertEquals($res, true);

        $res = Procedure::save("unscrew the affected part; remove the cables; remove the residues; apply new cables.");
        $this->assertEquals($res, false);  

        $res = Procedure::save("");
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
        $json_string = Procedure::getProcedures();
        $expected = file_get_contents("test_files\procedures.json");
        $this->assertEquals($expected, $json_string);
    }

    function testUpdateProcedure() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("SELECT description FROM MainProcedure where mpid = 2");

        $row = pg_fetch_row($res);
        $oldDesc = $row[0];

        $ret = Procedure::updateProcedure(2, "testDesc");
        $this->assertEquals($ret, true);

        $ret = Procedure::updateProcedure(2, $oldDesc);
        $this->assertEquals($ret, true);

        $ret = Procedure::updateProcedure(2, "unscrew the affected part; remove the cables; remove the residues; apply new cables.");
        $this->assertEquals($ret, false);

        $ret = Procedure::updateProcedure(-3, "testDesc");
        $this->assertEquals($ret, false);

        $ret = Procedure::updateProcedure(2, "");
        $this->assertEquals($ret, false);
        
        pg_close($conn);
    }


    function testRemoveProcedure(){
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("SELECT description FROM MainProcedure where mid = 2");

        $row = pg_fetch_row($res);
        $oldName = $row[0];

        $ret = Procedure::removeProcedure(2);
        $this->assertEquals($ret, true);

        $ret = Procedure::removeProcedure(-3);
        $this->assertEquals($ret, false);

        $res = Procedure::save($oldName);

        pg_close($conn);
    }

}
