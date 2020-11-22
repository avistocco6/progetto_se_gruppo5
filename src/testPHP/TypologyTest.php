<?php


use PHPUnit\Framework\TestCase;
include_once '..\items\Typology.php';

class TypologyTest extends TestCase {
    private function testTypology() {
        return new Typology(5, "Electrical");
    }

    public function test_get_id() {
        $typology = $this->testTypology();

        $this->assertEquals($typology->get_id(), 5);
    }

    public function test_get_description() {
        $typology = $this->testTypology();

        $this->assertEquals($typology->get_description(), "Electrical");
    }

    public function test_set_id() {
        $typology = $this->testTypology();

        $typology->set_id(10);
        $this->assertEquals($typology->get_id(), 10);
    }

    public function test_set_description() {
        $typology = $this->testTypology();

        $typology->set_description("Mechanical");
        $this->assertEquals($typology->get_description(), "Mechanical");
    }

    public function test_save_from_json() {
        $json_data = file_get_contents('..\..\json_templates\typology.json');
        $res = Typology::save($json_data);
        $this->assertEquals($res, true);
    }
}
