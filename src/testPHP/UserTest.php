<?php

//The following test cases are documented in the directory "documenti testing". 
//PHPUnit is the tool used to test.
//Function assertEquals verifies if the desired output is equal to the obtained output.
//Singleton pattern is used.
//These methods are the corresponding methods of the User class in items package.
use PHPUnit\Framework\TestCase;
include_once '..\items\User.php';
include_once '..\items\Skill.php';

class UserTest extends TestCase {
    public function testSave() {
        $user = User::getInstance();
        $res = $user->save("testUser", "testPass", "planner", "test@gmail.com");
        $this->assertEquals($res, true);

        $connector = new PgConnection();
        $conn = $connector->connect();

        $res = $user->save("Pippo1", "testPass", "planner", "test@gmail.com");
        $this->assertEquals($res, false);   

        $res = $user->save("", "testPass", "planner", "test@gmail.com");
        $this->assertEquals($res, false);  

        $res = $user->save("testUser", "", "planner", "test@gmail.com");
        $this->assertEquals($res, false);  

        $res = $user->save("testUser", "testPass", "engineer", "test@gmail.com");
        $this->assertEquals($res, false);  

        $res = $user->save("testUser", "testPass", "", "test@gmail.com");
        $this->assertEquals($res, false);         

        $res = $user->save("testUser", "testPass", "planner", "p.p@gmail.com");
        $this->assertEquals($res, false);

        $res = $connector->query("DELETE FROM Client where username = 'testUser'");
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


        //username is a empty string
        $res = $user->assignSkill("", "testskill");
        $this->assertEquals($res, false);

        //assignin non existing user
        $res = $user->assignSkill("xxxtest", "testskill");
        $this->assertEquals($res, false);


        //assignin a empty string
        $res = $user->assignSkill("testuser", "");
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
        $res = $user->removeUser("testuser");
        $this->assertEquals($res, false);
    }

    function testUpdateEmail() {
        $user = User::getInstance();
        $user->save("test", "123", "mantainer", "test@gmail.com");

        //existing user - not existing email
        $res =$user->updateEmail("test", "testuser@gmail.com");
        $this->assertEquals($res, true);

        //existing user - empty string
        $res =$user->updateEmail("test", "");
        $this->assertEquals($res, false);


        //non existing user - non existing email
        $res =$user->updateEmail("testUser", "testuser@gmail.com");
        $this->assertEquals($res, false);

        //empty string - not existing email
        $res =$user->updateEmail("", "testuser@gmail.com");
        $this->assertEquals($res, false);        
    }

    function testUpdatePassword() {
        $user = User::getInstance();
        $user->save("test", "testPass", "mantainer", "test@gmail.com");

        //existing user - allowed password
        $res =$user->updatePassword("test", "testPass");
        $this->assertEquals($res, true);

        //existing user - empty string
        $res =$user->updatePassword("test", "");
        $this->assertEquals($res, false);

        $user->removeUser("test");

        //non existing user - allowed password
        $res =$user->updatePassword("testUser", "testPass");
        $this->assertEquals($res, false);

         //empty string - allowed password
        $res =$user->updatePassword("", "testPass");
        $this->assertEquals($res, false);
    }

    function testCheckPassword() {
        $user = User::getInstance();
        $user->save("test", "123", "mantainer", "test@gmail.com");

        //existing user and correct password
        $res =$user->checkPassword("test", "123");
        $this->assertEquals($res, true);

        //existing user and empty string
        $res =$user->checkPassword("test", "");
        $this->assertEquals($res, false);

        //existing user and incorrect password
        $res =$user->checkPassword("test", "1235gwg15551");
        $this->assertEquals($res, false);

        $user->removeUser("test");

        //non existing user and allowed password
        $res =$user->checkPassword("testUser", "123515551");
        $this->assertEquals($res, false);

        //empty user and allowed password
        $res =$user->checkPassword("", "123515551");
        $this->assertEquals($res, false);
    }
}
