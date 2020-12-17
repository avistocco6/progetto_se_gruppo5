<?php
//The following test cases are documented in the directory "documenti testing". 
//PHPUnit is the tool used to test.
//Function assertEquals verifies if the desired output is equal to the obtained output.
//Singleton pattern is used.
//These methods are the corresponding methods of the Skill class in items package.

use PHPUnit\Framework\TestCase;
include_once '..\items\Skill.php';

class SkillTest extends TestCase
{
    public function testSave() {
        $skill = Skill::getInstance();
        $res = $skill->save("test");
        $this->assertEquals($res, true);

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = pg_query("DELETE FROM Skill where skillname = 'test'");

        $res = $skill->save("PAV Certification");
        $this->assertEquals($res, false);

        $res = $skill->save("");
        $this->assertEquals($res, false);

        pg_close($conn);
    }

    function test_get_skills() {
        $skill = Skill::getInstance();
        $json_string = $skill->getSkills();
        $expected = file_get_contents("test_files\skills.json");
        $this->assertEquals($expected, $json_string);
    }

    function test_update_skill() {
        $skill = Skill::getInstance();
        $skill->save("testS");

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT skid FROM Skill
                                    WHERE skillname = 'testS'");

        $n = pg_fetch_row($res)[0];

        $ret = $skill->updateSkill($n, "test");
        $this->assertEquals($ret, true);

        $skill->removeSkill($n);

        $ret = $skill->updateSkill(-3, "test");
        $this->assertEquals($ret, false);

        $ret = $skill->updateSkill($n, "PAV Certification");
        $this->assertEquals($ret, false);

        $ret = $skill->updateSkill($n, "");
        $this->assertEquals($ret, false);
    }

    function testRemoveSkill() {
        $skill = Skill::getInstance();
        $skill->save("testS");

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("SELECT skid FROM Skill
                                    WHERE skillname = 'testS'");

        $n = pg_fetch_row($res)[0];

        $ret = $skill->removeSkill($n);
        $this->assertEquals($ret, true);

        $ret = $skill->removeSkill(-5);
        $this->assertEquals($ret, false);

    }
}
