<?php


use PHPUnit\Framework\TestCase;

class PgConnectionTest extends TestCase {
    public function testConnect() {
        $connector = new PgConnection();

        $connection = $connector->connect();
        $this->assertNotEquals($connection, false);
    }
}
?>
