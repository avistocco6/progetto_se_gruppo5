<?php


use PHPUnit\Framework\TestCase;
include_once '..\items\Skill.php';

class SkillTest extends TestCase
{
    public function testSave() {
        $res = Skill::save("test");
        $this->assertEquals($res, true);

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("DELETE FROM Skill where skillname = 'test'");

        pg_close($conn);
    }

    function test_get_skills() {
        $json_string = Skill::getSkills();
        $expected = file_get_contents("test_files\skills.json");
        $this->assertEquals($expected, $json_string);
    }

    function test_update_skill() {
        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT skillname FROM Skill where skid = 1");

        $row = pg_fetch_row($res);
        $oldName = $row[0];

        $ret = Skill::updateSkill(1, "test");
        $this->assertEquals($ret, true);

        $ret = Skill::updateSkill(1, $oldName);
        $this->assertEquals($ret, true);
    }
}
