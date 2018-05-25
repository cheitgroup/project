<?php

namespace Pupuga\Core\Base;

use Pupuga\Libs\Files;

abstract class Controller
{
    public $alias;
    public $atts;
    public $content;
    public $data;
    public $pathTemplates;

    public function __construct($pathTemplates = null)
    {
        $this->setVars($pathTemplates);
        $this->hook();
        $this->setDoc();
    }

    abstract protected function boot();

    /**
     * Module documentation
     */
    abstract protected function doc();


    protected function setVars($pathTemplates)
    {
        $aliasArray = explode('\\', strtolower(get_class($this)));
        $this->alias = strval($aliasArray[count($aliasArray) - 2]);
        $this->pathTemplates = $pathTemplates ?: __DIRMODULES__ . ucfirst($this->alias) . '/templates/';
    }

    protected function setDoc()
    {
        /**
         * @var \Pupuga\Modules\Doc\Template $class
         */
        $class = '\Pupuga\Modules\Doc\Template';
        if (is_admin() && class_exists($class)) {
            $class::app()->setDocModule($this->doc());
        }
    }

    protected function hook()
    {
        add_shortcode($this->alias, array($this, 'shortCode'));
    }

    public function shortCode($atts, $content = null)
    {
        $html = $this->getHtml($atts, $content);

        return $html;
    }

    public function getHtml($atts, $content = null)
    {
        $this->atts = $atts;
        $this->content = $content;
        $this->data = $this->boot();

        $template = (isset($this->atts['template']) && $this->atts['template']) ? $this->atts['template'] : $this->alias;
        $html = Files\Files::getTemplate($template, false, $this, $this->pathTemplates);

        return $html;
    }

    public function getShortCodeContent()
    {
        $content = (isset($this->content) && !empty($this->content)) ? do_shortcode($this->content) : '';

        return $content;
    }

    public function getLoop($dataParams = null, $template = null)
    {
        $html = '';
        if (is_null($template)) {
            $template = $this->alias . '-one';
        }
        $dataParams = $dataParams ?: $this->data;
        foreach ($dataParams as $data) {
            $html .= Files\Files::getTemplate($template, false, $data, $this->pathTemplates);
        }

        return $html;
    }
}