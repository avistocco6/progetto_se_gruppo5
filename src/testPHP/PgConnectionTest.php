<?php


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
