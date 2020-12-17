<?php
//The following test cases are documented in the directory "documenti testing". 
//PHPUnit is the tool used to test.
//Function assertEquals verifies if the desired output is equal to the obtained output.
//Singleton pattern is used.
//These methods are the corresponding methods of the Material class in items package.

use PHPUnit\Framework\TestCase;
//include '..\..\json_save_templates\materials.json';
include_once '..\items\Material.php';

class MaterialTest extends TestCase {

    public function testSave() {
        $material = Material::getInstance();
        $res = $material->save("testMaterial");
        $this->assertEquals($res, true);

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("DELETE FROM Material where matname = 'testMaterial'");

        $res = $material->save("cables");
        $this->assertEquals($res, false);

        $res = $material->save("");
        $this->assertEquals($res, false);

        pg_close($conn);
    }

    function testGetMaterials() {
        $material = Material::getInstance();
        $json_string = $material->getMaterials();
        $expected = file_get_contents("test_files\materials.json");
        $this->assertEquals($expected, $json_string);
        
    }

    function testUpdateMaterial() {
        $material = Material::getInstance();
        $material->save("testM");

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT mid FROM Material
                                    WHERE matname = 'testM'");

        $n = pg_fetch_row($res)[0];

        $ret = $material->updateMaterial($n, "testNM");
        $this->assertEquals($ret, true);

        $ret = $material->updateMaterial($n, "testUpdate");
        $this->assertEquals($ret, true);

        $material->removeMaterial($n);
        $ret = $material->updateMaterial(-3, "testUpdate");
        $this->assertEquals($ret, false);

        $ret = $material->updateMaterial(2, "wheel");
        $this->assertEquals($ret, false);

        $ret = $material->updateMaterial(2, "");
        $this->assertEquals($ret, false);

    }


    function testRemoveMaterial() {
        $material = Material::getInstance();
        $material->save("testM");

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT mid FROM Material
                                    WHERE matname = 'testM'");

        $n = pg_fetch_row($res)[0];

        $ret = $material->removeMaterial($n);
        $this->assertEquals($ret, true);

        $ret = $material->removeMaterial(-5);
        $this->assertEquals($ret, false);

    }

}
