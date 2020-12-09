<?php


use PHPUnit\Framework\TestCase;
include_once '..\items\User.php';
include_once '..\items\Skill.php';

class UserTest extends TestCase {
    public function testSave() {
        $user = User::getInstance();
        $res = $user->save("test", "123", "mantainer", "test@gmail.com");
        $this->assertEquals($res, true);

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $connector->query("DELETE FROM Client where username = 'test'");

        pg_close($conn);
    }

    function testAssignSkill() {
        $user = User::getInstance();
        $user->save("testuser", "123", "mantainer", "test@gmail.com");
        $skill = Skill::getInstance();
        $skill->save("testskill");

        //assignin existing skill
        $res = $user->assignSkill("testuser", "testskill");
        $this->assertEquals($res, true);

        //assignin non existing skill
        $res = $user->assignSkill("testuser", "xxxxtest");
        $this->assertEquals($res, false);

        //assignin non existing user
        $res = $user->assignSkill("xxxtest", "testskill");
        $this->assertEquals($res, false);

        //assignin skill to planner
        $user->save("testplanner", "123", "planner", "test@gmail.com");
        $res = $user->assignSkill("testplanner", "testskill");
        $this->assertEquals($res, false);

        $connector = new PgConnection();
        $conn = $connector->connect();

        $connector->query("DELETE FROM Client where username = 'testuser'");
        $connector->query("DELETE FROM Client where username = 'testplanner'");
        $connector->query("DELETE FROM Skill where skillname = 'testskill'");

        pg_close($conn);
    }

    function testGetUsers() {
        $user = User::getInstance();
        $json_string = $user->getUsers();
        $expected = file_get_contents('test_files\users.json');
        $this->assertEquals($expected, $json_string);
    }

    function testRemoveUser() {
        $user = User::getInstance();
        $user->save("test", "123", "mantainer", "test@gmail.com");

        //testing existing user
        $res = $user->removeUser("test");
        $this->assertEquals($res, true);

        //testing non existing user
        $res = $user->removeUser("test");
        $this->assertEquals($res, false);
    }

    function testUpdateEmail() {
        $user = User::getInstance();
        $user->save("test", "123", "mantainer", "test@gmail.com");

        //existing user
        $res =$user->updateEmail("test", "123");
        $this->assertEquals($res, true);

        $user->removeUser("test");

        //non existing user
        $res =$user->updateEmail("test", "123");
        $this->assertEquals($res, false);
    }

    function testUpdatePassword() {
        $user = User::getInstance();
        $user->save("test", "123", "mantainer", "test@gmail.com");

        //existing user
        $res =$user->updateEmail("test", "12341415");
        $this->assertEquals($res, true);

        $user->removeUser("test");

        //non existing user
        $res =$user->updateEmail("test", "123");
        $this->assertEquals($res, false);
    }

    function testCheckPassword() {
        $user = User::getInstance();
        $user->save("test", "123", "mantainer", "test@gmail.com");

        //existing user and correct password
        $res =$user->checkPassword("test", "123");
        $this->assertEquals($res, true);

        //existing user and incorrect password
        $res =$user->checkPassword("test", "1235gwg15551");
        $this->assertEquals($res, false);

        $user->removeUser("test");

        //non existing user
        $res =$user->checkPassword("test", "123515551");
        $this->assertEquals($res, false);
    }
}
