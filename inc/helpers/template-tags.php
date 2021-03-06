<?php
/**
 * Custom template tags for the theme.
 *
 * @package Aquila
 */

/**
 * Gets the thumbnail with Lazy Load.
 * Should be called in the WordPress Loop.
 *
 * @param int|null $post_id               Post ID.
 * @param string   $size                  The registered image size.
 * @param array    $additional_attributes Additional attributes.
 *
 * @return string
 */

 function get_the_post_custom_thumbnail( $post_id, $size = 'feature-image', $additional_attributes = []){
    $custome_thumbnail = '';
    if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

    if ( has_post_thumbnail( $post_id ) ) {
		$default_attributes = [
			'loading' => 'lazy'
		];

        $attributes = array_merge( $additional_attributes, $default_attributes );

        echo '<pre>';
        print_r($attributes);
        wp_die();

        $custome_thumbnail = wp_get_attachment_image( get_post_thumbnail_id(
            $post_id ),
            $size,
            false,
            $attributes
        );
    }
       return $custome_thumbnail; 
}

/**
 * Renders Custom Thumbnail with Lazy Load.
 *
 * @param int    $post_id               Post ID.
 * @param string $size                  The registered image size.
 * @param array  $additional_attributes Additional attributes.
 */
function the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = [] ) {
	echo get_the_post_custom_thumbnail( $post_id, $size, $additional_attributes );
}

?>
