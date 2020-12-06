<?php

include_once dirname(__FILE__) . '..\items\Material.php';
use PHPUnit\DbUnit\TestCaseTrait;

class MaterialDBTest extends PHPUnit_Extensions_Database_testCase {

    protected $connector;

    public function __construct() {
        $this->connector = $this->getConnector();
    }

    protected function getConnector() {
        return new PgConnection();
    }

    protected  function getConnection() {
        return $this->creae();
    }
}