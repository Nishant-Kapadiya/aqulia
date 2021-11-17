<?php
/**
 * Bootstraps the Theme.
 *
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class AQUILA_THEME {
	use Singleton;

	protected function __construct() {

		// load class.
		Assets::get_instance();
		Menus::get_instance();
		Meta_Boxes::get_instance();
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		/**
		 * Actions
		 */
		add_action( 'after_setup_theme', [$this, 'setup_theme'] );
	}

	public function setup_theme() {

		// Add the title-tag
		add_theme_support( 'title-tag' );

		// Add the custom-logo
		add_theme_support( 'custom-logo',[
			'header-text'          => ['site-title', 'site-description'],
			'height'               => 100,
			'width'                => 400,
			'flex-height'          => true,
			'flex-width'           => true
		] );

		// Add the custom-background
		add_theme_support( 'custom-background',[
			'default-color' => '#fff',
    		'default-image' => '',
			'default-repeat' => 'no-repeat',
		] );

		// Add the post-thumbnails
		add_theme_support( 'post-thumbnails' );

		/**
		 * Register Image Size
		 */
		add_image_size( 'feature-thumbnail', 350, 233, true );

		// Add the customize-selective-refresh-widgets
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add the automatic-feed-links
		add_theme_support( 'automatic-feed-links' );

		// Add the HTML5 support
		add_theme_support( 'html5', [ 
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption',
			'style',
			'script' ] );

			// add the editor style
			add_editor_style();

			// Add the wp block style
			add_theme_support( 'wp-block-styles' );

			// Add the align-wide for images
			add_theme_support( 'align-wide');

			global $content_width;
			if (!isset( $content_width)){
				$content_width = 1240;
			}

	}
}
