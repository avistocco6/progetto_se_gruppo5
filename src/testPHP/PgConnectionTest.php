<?php


use PHPUnit\Framework\TestCase;
include '../PgConnection.php';

class PgConnectionTest extends TestCase {
    public function testConnect() {
        $connector = new PgConnection();

        $connection = $connector->connect();
        $this->assertNotEquals($connection, false);
    }
}
?>
