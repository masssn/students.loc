<?php

/*
 * сделал трейт-синглтон, на всякий случай
 */

namespace app;

trait Singleton
{

    protected static $instance;

    public static function getInstance()
    {
        if (static::$instance === NULL) {
            static::$instance = new static;
        }
        return static::$instance;
    }

}
