<?php


use PHPUnit\Framework\TestCase;
include_once '..\Client.php';

class ClientTest extends TestCase
{
    private function testClient() {
        return new Client("maintainer01", "abcdef", "Mario Rossi", "Maintainer");
    }

    public function test_getUsername() {
        $client = $this->testClient();

        $this->assertEquals($client->getUsername(), "maintainer01");
    }

    public function test_getPassword() {
        $client = $this->testClient();

        $this->assertEquals($client->getPassword(), "abcdef");
    }

    public function test_getName() {
        $client = $this->testClient();

        $this->assertEquals($client->getName(), "Mario Rossi");
    }

    public function test_getNumCompetences() {
        $client = $this->testClient();

        $this->assertEquals($client->getNumCompetences(), 0);
    }

    public function test_getRole() {
        $client = $this->testClient();

        $this->assertEquals($client->getRole(), "Maintainer");
    }

    public function test_setUsername() {
        $client = $this->testClient();

        $client->setUsername("mario01");
        $this->assertEquals($client->getUsername(), "mario01");
    }

    public function test_setPassword() {
        $client = $this->testClient();

        $client->setPassword("mario12341");
        $this->assertEquals($client->getPassword(), "mario12341");
    }

    public function test_setName() {
        $client = $this->testClient();

        $client->setName("Mario Neri");
        $this->assertEquals($client->getName(), "Mario Neri");
    }

    public function test_setNumCompetences() {
        $client = $this->testClient();

        $client->setNumCompetences(4);
        $this->assertEquals($client->getNumCompetences(), 4);
    }

    public function test_setRole() {
        $client = $this->testClient();

        $client->setRole("Planner");
        $this->assertEquals($client->getRole(), "Planner");
    }

    public function test_save() {
        $json_data = file_get_contents('..\..\json_templates\client.json');
        $res = Client::save($json_data);
        $this->assertEquals($res, true);
    }

    public function test_assignSkill() {
        $json_data = file_get_contents('..\..\json_templates\skill_assignation.json');
        $res = Client::assignSkill($json_data);
        $this->assertEquals($res, true);
    }
}
