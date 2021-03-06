<?php

namespace Pupuga\Core\Init;

class Correct
{

    public function __construct()
    {
        // init theme config
        add_action('after_setup_theme', array($this, 'removeAdminBar'));
        add_action('after_setup_theme', array($this, 'themeSetupRemove'));
        add_action('after_setup_theme', array($this, 'themeSetupSupport'));
    }

    public function removeAdminBar()
    {
        if (current_user_can('subscriber') && !is_admin()) {
            show_admin_bar(false);
        }
    }

    public function themeSetupRemove()
    {
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'start_post_rel_link', 10);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
        remove_action('wp_head', 'parent_post_rel_link', 10);
        remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    }

    public function themeSetupSupport()
    {
        // supports a variety of post formats.
        add_theme_support('post-formats', array('aside', 'image', 'link', 'quote', 'status'));
        // supports custom logo
        add_theme_support('custom-logo');
        // actions short code in widgets
        add_filter('widget_text', 'do_shortcode');
        // add menus
        add_theme_support('menus');
    }
}