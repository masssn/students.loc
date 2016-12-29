<?php
/*
 * простая реализация автозагрузки классов
 */
spl_autoload_register('autoload');

function autoload($class)
{
    require_once getcwd() . '/' . $class . '.php';
}
