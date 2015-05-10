<?php

abstract class BaseModel {
    protected static $db;

    public function __construct() {
        $dbinstance = Database::get_instance();
        self::$db = $dbinstance->get_db();
    }
}
