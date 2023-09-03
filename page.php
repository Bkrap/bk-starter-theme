<?php get_header(); ?>
    <?php
    global $post;
    $is_restricted = get_post_meta($post->ID, 'ihc_mb_who', true);
    // debug(get_post_meta($post->ID, 'ihc_mb_who', true));
    if( $is_restricted && !is_user_logged_in() ) {
        the_content();
    } else {
        if( FlexibleContent('page_builder') ) {
        } else {
            the_content();
        }
    }
    ?>
<?php get_footer(); ?>