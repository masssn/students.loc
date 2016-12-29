<?php

/*
 * Простой класс для соединения с БД.
 */

namespace app;

class DB
{
    protected $settings = [];

    public function __construct()
    {
        $this->settings = parse_ini_file("db config.ini");
    }

    public function conect()
    {
        try { 
            $db = new \PDO("{$this->settings["driver"]}"
                    . ":host={$this->settings["host"]};"
                    . "dbname={$this->settings["dbname"]}", $this->settings["user"], $this->settings["password"]);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (\PDOException $ex) {
            echo 'Что-то пошло не так: ' . $ex->getCode();
        }
    }

}
