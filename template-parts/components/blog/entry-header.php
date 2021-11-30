<?php
/**
 * Template for post entry header
 *
 * @package Aquila
 */

 $the_post_id = get_the_ID();
 $hide_title = get_post_meta( $the_post_id, '_hide_page_title', true );
//  echo '<pre>';
//  print_r( $the_post_id . ' ' . $hide_title);
//  wp_die();
 $has_post_thumbnail = has_post_thumbnail( $the_post_id );
?>
<header class="entery-header">
    <?php if ( $has_post_thumbnail ) : ?>
        <div class="entry-image mb-3">
            <a href="<?php echo esc_url( get_permalink() ); ?>">
                <?php echo get_the_post_thumbnail(
                    $the_post_id,
                    'feature-thumbnail',
                    [
                        'class' => 'attachment-featured-large size-featured-image',
                        'size'   => '(max-width: 350px) 350px 233px'
                    ]
                    );
                ?>
            </a>
        </div>
    <?php 
        endif;
        
        //Title 
        if ( is_single() || is_page() ) {
            printf(
                '<h1 class="page-title text-dark %1$s">%2$s</h1>',
                esc_attr( $heading_class ),
                wp_kses_post( get_the_title() )
            );
        } else {
            printf(
                '<h2 class="entry-title post-card-title mb-3"><a class="text-dark" href="%1$s">%2$s</a></h2>',
                esc_url( get_the_permalink() ),
                wp_kses_post( get_the_title() )
            );
        }
    ?>

</header>