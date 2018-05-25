<?php

namespace Pupuga\Core\Init;

use Pupuga\Core\Load;

class PageMain
{

    public function __construct()
    {
        add_action('get_footer', array($this, 'addStylesScripts'));
    }

    public function addStylesScripts()
    {
        wp_enqueue_style('style', __URLMAIN__ . 'style.css');
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-migrate');
        wp_localize_script('jquery', 'globalVars', array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('check-nonce')
        ));

        $enqueues = array(
            'styles' => array(
                'style-bundle' => 'bundle.css',
                'style-main' => 'main.css'
            ),
            'scripts' => array(
                'script-bundle' => 'bundle.js',
                'script-main' => 'main.js'
            )
        );

        Load\StylesScripts::app()->requireStylesScripts($enqueues);

    }
}
