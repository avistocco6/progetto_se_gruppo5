<?php


use PHPUnit\Framework\TestCase;
include '..\items\Site.php';

class SiteTest extends TestCase {
    private function testSite() {
        return new Site(5, "Nusco", "Carpentry");
    }

    public function test_get_id() {
        $site = $this->testSite();

        $this->assertEquals($site->get_id(), 5);
    }

    public function test_get_branch() {
        $site = $this->testSite();

        $this->assertEquals($site->get_branch(), "Nusco");
    }

    public function test_get_department() {
        $site = $this->testSite();

        $this->assertEquals($site->get_department(), "Carpentry");
    }

    public function test_set_id() {
        $site = $this->testSite();

        $site->set_id(2);
        $this->assertEquals($site->get_id(), 2);
    }

    public function test_set_branch() {
        $site = $this->testSite();

        $site->set_branch("Fisciano");
        $this->assertEquals($site->get_branch(), "Fisciano");
    }

    public function test_set_department() {
        $site = $this->testSite();

        $site->set_department("Molding");
        $this->assertEquals($site->get_department(), "Molding");
    }

    public function test_save_from_json() {
        $json_data = file_get_contents('..\..\json_templates\site.json');
        $res = Site::save($json_data);
        $this->assertEquals($res, true);
    }
}
