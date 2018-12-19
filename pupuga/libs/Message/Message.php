<?php

namespace Pupuga\Libs\Message;

use Pupuga\Libs\Files\Files;

class Message {

    protected $message = array(
        'warning-have-subscription' => array(
          'type' => 'error',
          'text' => ''
        ),
        'warning-subscription-expired' => array(
          'type' => 'error',
          'text' => ''
        )
    );

    public static $instance;

    private function __construct()
    {
    }

    /**
     * @return $this
     */
    static function app()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getMessage($type = null)
    {
        if (is_null($type) && (isset($_GET['message']) && isset($this->message[$_GET['message']]))) {
            $type = $_GET['message'];
        }

        if (!is_null($type) && isset($this->message[$type])) {
            Files::getTemplatePupuga('message', true, $this->message[$type]);
        }
    }
}