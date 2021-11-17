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
        add_action( 'save_post', [ $this, 'save_post_meta_data' ] );
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

    /**
	 * Save post meta into database
	 * when the post is saved.
	 *
	 * @param integer $post_id Post id.
	 *
	 * @return void
	 */
    public function save_post_meta_data( $post_id ) {
        /**
		 * When the post is saved or updated we get $_POST available
		 * Check if the current user is authorized
		 */
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        /**
		 * Check if the nonce value we received is the same we created.
		 */
		if ( ! isset( $_POST['hide_title_meta_box_nonce_name'] ) ||
		     ! wp_verify_nonce( $_POST['hide_title_meta_box_nonce_name'], plugin_basename(__FILE__) )
		) {
			return;
		}
        
        if ( array_key_exists( 'aquila_hide_title_field', $_POST ) ) {
			update_post_meta(
				$post_id,
				'_hide_page_title',
				$_POST['aquila_hide_title_field']
			);
		}
    }
}
?>