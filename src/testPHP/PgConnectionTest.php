<?php

//Function assertEquals verifies if the desired output is equal to the obtained output.
//This function tests the correct behaviour of the connection to the database.

use PHPUnit\Framework\TestCase;
include_once '../PgConnection.php';

class PgConnectionTest extends TestCase {
    public function testConnect() {
        $connector = new PgConnection();

        $connection = $connector->connect();
        $this->assertNotEquals($connection, false);
    }
}
?>
