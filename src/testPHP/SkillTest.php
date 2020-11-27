<?php


use PHPUnit\Framework\TestCase;
include_once '..\items\Skill.php';

class SkillTest extends TestCase
{
    private function testSkill() {
        return new Skill( "Knowledge of cable types");
    }

    public function test_get_name() {
        $skill = $this->testSkill();

        $this->assertEquals($skill->get_name(), "Knowledge of cable types");
    }


    public function test_set_name() {
        $skill = $this->testSkill();

        $skill->set_name("Robot knowledge");
        $this->assertEquals($skill->get_name(), "Robot knowledge");
    }

    public function test_save_from_json() {
        $json_data = file_get_contents('..\..\json_save_templates\skill.json');
        $res = Skill::save($json_data);
        $this->assertEquals($res, true);
    }

    function test_get_skills() {
        $json_string = Skill::get_skills();
        $expected = file_get_contents("test_files\skills.json");
        $this->assertEquals($expected, $json_string);
    }

    function test_update_skill() {
        $json_string = '{"id": 1, "name": "updateTest"}';
        $ret = Skill::updateSkill($json_string);
        $this->assertEquals($ret, true);
    }
}
