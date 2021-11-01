<?php
/**
 * Enqueue theme assetes
 * 
 * @package aqulia
 */
namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Assets {
	use Singleton;

	protected function __construct() {

		// load class.
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		/**
		 * Actions
		 */
		add_action( 'init', [$this, 'register_menus'] );
	}

    public function register_menus() {
        register_nav_menus([
            'aqulia-primary-menu' => esc_html__('Primary Menu', 'aqulia'),
            'aqulia-footer-menu' => esc_html__('Footer Menu', 'aqulia'),
        ]);
    }

}
