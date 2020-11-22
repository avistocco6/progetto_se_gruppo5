<?php


use PHPUnit\Framework\TestCase;
//include '..\..\json_templates\material.json';
include_once '..\items\Material.php';

class MaterialTest extends TestCase {
    private function testMaterial() {
        return new Material(4, "Cuscinetto", 2);
    }

    public function test_get_id() {
        $material = $this->testMaterial();

        $this->assertEquals($material->get_id(), 4);
    }

    public function test_get_name() {
        $material = $this->testMaterial();

        $this->assertEquals($material->get_name(), "Cuscinetto");
    }

    public function test_get_activity() {
        $material = $this->testMaterial();

        $this->assertEquals($material->get_activity(), 2);
    }

    public function test_set_id() {
        $material = $this->testMaterial();
        $material->set_id(23);
        $this->assertEquals($material->get_id(), 23);
    }

    public function test_set_activity() {
        $material = $this->testMaterial();
        $material->set_activity(12);
        $this->assertEquals($material->get_activity(), 12);
    }

    public function test_set_name() {
        $material = $this->testMaterial();
        $material->set_name("Vite");
        $this->assertEquals($material->get_name(), "Vite");
    }

    public function test_save_from_json() {
        $json_data = file_get_contents('..\..\json_templates\material.json');
        $res = Material::save($json_data);
        $this->assertEquals($res, true);
    }
}
