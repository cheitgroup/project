<?php

namespace Pupuga\Core\Base;

class Common
{
    public $config;
    public $common;
    private static $instance;

    /**
     * @return $this
     */
    public static function app()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

}