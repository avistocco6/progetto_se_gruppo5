<?php


use PHPUnit\Framework\TestCase;
include_once '..\items\Procedure.php';

class ProcedureTest extends TestCase
{

    private function testProcedure() {
        return new Procedure("desc", 1, );
    }

    public function testGetActivity() {
        $proc = $this->testProcedure();

        $this->assertEquals(1, $proc->getDescription());
    }

    public function testSetSmp() {
        $proc = $this->testProcedure();

        $proc->setSmp("test_procedure.txt");
        $this->assertEquals("test_procedure.txt", $proc->getSmp());
    }

    public function testGetSmp() {
        $proc = $this->testProcedure();

        $proc->setSmp("test_procedure.txt");
        $this->assertEquals("TEST", $proc->getSmp());
    }

    public function testSetActivity() {
        $proc = $this->testProcedure();

        $proc->setActivity(2);
        $this->assertEquals(2, $proc->getActivity());
    }

    public function testSetDescription() {
        $proc = $this->testProcedure();

        $proc->setDescription("desc2");
        $this->assertEquals("desc2", $proc->getDescription());
    }

    public function testGetDescription() {
        $proc = $this->testProcedure();

        $this->assertEquals("desc", $proc->getDescription());
    }

    public function testSave() {
        $json_data = file_get_contents('..\..\json_templates\procedure.json');
        $res = Procedure::save($json_data);
        $this->assertEquals($res, true);
    }

}
