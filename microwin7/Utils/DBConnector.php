<?php

namespace microwin7\Utils;

use \microwin7\Configs\Main;
use \microwin7\Exceptions\ServerNotFound;

class DBConnector
{
    protected $database = [];

    public function __get($database)
    {
        if (array_key_exists($database, $this->database)) return $this->database[$database];
        return $this->getConnect($database);
    }

    private function getConnect($database)
    {
        if (empty($database) || $database == Main::DB_NAME) $database = Main::DB_NAME;
        else {
            try {
                $database = strtolower(Main::DB_PREFIX . Main::getServerWithoutDefault($database));
            } catch (ServerNotFound $e) {
                $modules_keys_lower_case = array_change_key_case(Main::MODULES);
                $key_exists = array_key_exists(strtolower($database), $modules_keys_lower_case);
                if ($key_exists === true) {
                    $module = $modules_keys_lower_case[strtolower($database)];
                    $database = $module['DB_NAME'];
                } else {
                    $database = Main::DB_NAME;
                }
            }
        }
        if (array_key_exists($database, $this->database)) return $this->database[$database];
        return $this->database[$database] = new DBDriver($database, $module['prefix'] ?? '');
    }
}
