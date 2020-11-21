<?php
use PHPUnit\Framework\TestCase;

class TestPgConnection extends TestCase {
    public function testConnect() {
        $connector = new PgConnection();

        $connection = $connector->connect();
        $this->assertNotEquals($connection, false);
    }
}
?>