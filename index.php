<?php
/*
 * главный файл обрабатывающий запросы
 */
require 'app/autoload.php';
$controller = new app\controllers\Controller();
$controller->route();



