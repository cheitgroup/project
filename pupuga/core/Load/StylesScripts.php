<?php

namespace Pupuga\Core\Load;

class StylesScripts
{
    public static $instance;
    protected $enqueues;
    protected $dir = __DIRASSETS__;
    protected $url = __URLASSETS__;

    /**
     * @return $this
     */
    static function app()
    {
        self::$instance = new self();
        return self::$instance;
    }

    /**
     * @return $this
     */
    public function setDir($dir)
    {
        $this->dir = $dir;

        return $this;
    }

    /**
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }


    protected function requireFiles()
    {
        $enqueues = $this->enqueues;
        $dir = $this->dir;
        $url = $this->url;
        if (is_array($enqueues) && count($enqueues) > 0) {
            foreach ($enqueues as $type => $enqueue) {
                foreach ($enqueue as $name => $file) {
                    if (is_file($dir . $file)) {
                        switch ($type) {
                            case 'styles':
                                wp_enqueue_style($name, $url . $file);
                                break;
                            case 'scripts':
                                wp_enqueue_script($name, $url . $file, array(), null, true);
                                break;
                        }
                    }
                }
            }
        }
    }

    public function requireStylesScripts($enqueues)
    {
        $this->enqueues = $enqueues;
        $this->requireFiles();
    }
}
