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
    custome_thumbnail = '';
    if ( null !== $post_id ) {
        $the_post_id = get_the_ID();
    }
}

?>
