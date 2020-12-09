<?php


use PHPUnit\Framework\TestCase;
//include '..\..\json_save_templates\materials.json';
include_once '..\items\Material.php';

class MaterialTest extends TestCase {

    public function testSave() {
        $res = Material::save("testMaterial");
        $this->assertEquals($res, true);

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("DELETE FROM Material where matname = 'testMaterial'");

        $res = Material::save("cables");
        $this->assertEquals($res, false);

        $res = Material::save("");
        $this->assertEquals($res, false);

        pg_close($conn);
    }

    function testGetMaterials() {
        $json_string = Material::getMaterials();
        echo $json_string;
        $expected = file_get_contents("test_files\materials.json");
        $this->assertEquals($expected, $json_string);
        
    }

    function testUpdateMaterial() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("SELECT matname FROM Material where mid = 2");

        $row = pg_fetch_row($res);
        $oldName = $row[0];

        $ret = Material::updateMaterial(2, $oldName);
        $this->assertEquals($ret, true);

        $ret = Material::updateMaterial(2, "testUpdate");
        $this->assertEquals($ret, true);

        $ret = Material::updateMaterial(-3, "testUpdate");
        $this->assertEquals($ret, false);

        $ret = Material::updateMaterial(2, "wheel");
        $this->assertEquals($ret, false);

        $ret = Material::updateMaterial(2, "");
        $this->assertEquals($ret, false;

        pg_close($conn);

    }


    function testRemoveMaterial() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("SELECT matname FROM Material where mid = 1");

        $row = pg_fetch_row($res);
        $oldName = $row[0];

        $ret = Material::removeMaterial(1);
        $this->assertEquals($ret, true);

        $ret = Material::removeMaterial(-5);
        $this->assertEquals($ret, false);

        $res = Material::save($oldName);

        pg_close($conn);
    }

}
