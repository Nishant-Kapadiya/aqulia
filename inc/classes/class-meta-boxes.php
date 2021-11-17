<?php
/**
 * Register Meta Boxes
 * 
 * @package aqulia
 */
namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Meta_Boxes {
	use Singleton;

	protected function __construct() {

		// load class.
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		/**
		 * Actions
		 */
        add_action( 'add_meta_boxes', [ $this, 'register_meta_boxes' ] );
	}
    
    /**
     * Register Meta Boxes
     * 
     * @return void
    */
    public function register_meta_boxes() {
        $screens = [ 'post', 'wporg_cpt' ];
        foreach ( $screens as $screen ) {
            add_meta_box(
                'hide-page-title',                  // Unique ID
                __( 'Hide page title', 'aqulia' ),  // Box title
                [ $this, 'meta_box_callback' ],     // Content callback, must be of type callable
                $screen ,                            // Post type
                'side',                              // Context
            );
        }
    }

    /**
     * Meta Box Callback (HTML for form )
     * 
     * @param object $post Post.
	 *
	 * @return void
    */
    public function meta_box_callback( $post ) {

        /**
		 * Use nonce for verification.
		 * This will create a hidden input field with id and name as
		 * 'hide_title_meta_box_nonce_name' and unique nonce input value.
		 */
        
        wp_nonce_field( plugin_basename(__FILE__), 'hide_title_meta_box_nonce_name' );
        
        $value = get_post_meta( $post->ID, '_hide_page_title', true );
?>
        <label for="aquila-field">
            <?php esc_html_e( 'Hide the page title', 'aquila' ); ?>
        </label>
        <select name="aquila_hide_title_field" id="aquila-field" class="postbox">
			<option value=""><?php esc_html_e( 'Select', 'aquila' ); ?></option>
			<option value="yes" <?php selected( $value, 'yes' ); ?>>
				<?php esc_html_e( 'Yes', 'aquila' ); ?>
			</option>
			<option value="no" <?php selected( $value, 'no' ); ?>>
				<?php esc_html_e( 'No', 'aquila' ); ?>
			</option>
		</select>
<?php
    }
}
?>
