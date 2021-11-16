<?php
/**
 * Template for post entry header
 *
 * @package Aquila
 */

 $the_post_id = get_the_ID();
 $has_post_thumbnail = has_post_thumbnail( $the_post_id );
?>
<header class="entery-header">
    <?php if ( $has_post_thumbnail ) : ?>
        <div class="entry-image mb-3">
            <a href="<?php echo esc_url( get_permalink() ); ?>">
                <?php echo get_the_post_thumbnail(
                    $the_post_id,
                    'feature-large',
                    [
                        'class' => 'attachment-featured-large size-featured-image',
                        'size'   => '(max-width: 590px) 590px 425px'
                    ]
                    );
                ?>
            </a>
        </div>
    <?php endif; ?>

</header>