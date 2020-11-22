<?php


use PHPUnit\Framework\TestCase;
include_once '..\items\Skill.php';

class SkillTest extends TestCase
{
    private function testSkill() {
        return new Skill(31, "Knowledge of cable types");
    }

    public function test_get_id() {
        $skill = $this->testSkill();

        $this->assertEquals($skill->get_id(), 31);
    }

    public function test_get_name() {
        $skill = $this->testSkill();

        $this->assertEquals($skill->get_name(), "Knowledge of cable types");
    }

    public function test_set_id() {
        $skill = $this->testSkill();

        $skill->set_id(1);
        $this->assertEquals($skill->get_id(), 1);
    }

    public function test_set_name() {
        $skill = $this->testSkill();

        $skill->set_name("Robot knowledge");
        $this->assertEquals($skill->get_name(), "Robot knowledge");
    }

    public function test_save_from_json() {
        $json_data = file_get_contents('..\..\json_templates\skill.json');
        $res = Skill::save($json_data);
        $this->assertEquals($res, true);
    }
}
