<?php

namespace Pupuga\Core\Load;

use Pupuga\Libs\Files;
use Pupuga\Libs\Data\Html;

class Sections {
    
    public static $instance;

    /**
     * @return $this
     */
    static function app() {
        self::$instance = new self();
        return self::$instance;
    }

    public function getSections($slug) {
        $html  = '';
        $sections = carbon_get_the_post_meta($slug);
        if (is_array($sections) && count($sections) > 0){
            foreach ($sections as $section) {
                $htmlSubsections = '';
                $subsections = $section['subsections_loop'];
                if (is_array($subsections) && count($subsections) > 0) {
                    foreach ($subsections as $subsection) {
                        $htmlSubsections .= Files\Files::getTemplatePupuga('subsection', false, $subsection);
                    }
                }
                if ($htmlSubsections) {
                    $section['htmlSubsections'] = Html::cleanEmptyTagsHtml(wpautop(do_shortcode($htmlSubsections)));
                    $html .= Files\Files::getTemplatePupuga('section', false, $section);
                }
            }
        }

        return $html;
    }
}