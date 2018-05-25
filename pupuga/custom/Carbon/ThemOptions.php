<?php

namespace Pupuga\Custom\Carbon;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class ThemOptions {
	private static $instance;

	public function __construct() {
	}

	public static function app() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function addTeachers() {
		Container::make( 'theme_options', 'Teachers' )
		         ->set_page_parent( 'themes.php' )
		         ->add_fields( array(
			         Field::make( 'complex', 'teachers_connect', 'Connect' )
			              ->add_fields( array(
				              Field::make( 'text', 'teachers_item_label', 'Item label' ),
				              Field::make( 'text', 'teachers_item_data', 'data' ),
			              ) ),
		         ) );
	}

}

