<?php

namespace Pupuga\Libs\Send;

class Send
{
    private static $instance;
    public $parameters = array('to', 'subject', 'message', 'headers', 'attachments', 'phone', 'sms');

    function __construct($parameters = array())
    {
        $this->setPartsMail($parameters['mail'])->setHeadersMail();
        unset($parameters['mail']);

        $this->parameters = array_merge($this->parameters, $parameters);
    }

    public static function app($parameters = array())
    {
        self::$instance = new self($parameters);
        return self::$instance;
    }

    public function setHeadersMail()
    {
        remove_all_filters( 'wp_mail_from' );
        remove_all_filters( 'wp_mail_from_name' );

        $headers = array();
        $headers[] = 'From: ' . get_bloginfo('name') .' <' . get_bloginfo('admin_email') . '>';
        $headers[] = 'content-type: text/html';
        $this->parameters['headers'] = $headers;
    }

    public function setPartsMail($mail)
    {
        $mailParts = explode('||', $mail);
        if (count($mailParts) > 1) {
            $this->parameters['subject'] = trim($mailParts[0]);
            $this->parameters['message'] = trim($mailParts[1]);
        } else {
            $this->parameters['message'] = $mailParts[0];
        }

        return $this;
    }

    /**
     * replaces templates in message
     *
     * @param array $search
     * @param array $replace
     *
     * @return object $this
     */
    public function formatMessage($search, $replace)
    {
        if ((is_array($search) && is_array($replace)) || (is_string($search) && is_string($replace))) {
            $this->parameters['message'] = str_replace($search, $replace, $this->parameters['message']);
            $this->parameters['sms'] = str_replace($search, $replace, $this->parameters['sms']);
        }

        return $this;
    }

    /**
     * send message
     *
     * @param array, string $types
     * @return array $result
     */
    public function send($types = array('mail', 'sms'))
    {
        $sends = array();
        if (!is_array($types) && is_string($types)) {
            $sends[] = $types;
        } else {
            $sends = $types;
        }

        $result = array();

        foreach($sends as $send) {
            $result[] = $this->$send();
        }

        return $result;
    }

    public function mail()
    {
        $result = mail($this->parameters['to'], $this->parameters['subject'], $this->parameters['message'], $this->parameters['headers'], $this->parameters['attachments']);

        return $result;
    }

    public function sms()
    {
        $result = false;

        return $result;
    }

}