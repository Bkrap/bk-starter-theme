<?php
get_header();
?>

<div>
    <?php //print_r( wp_get_current_user() ); ?>
    <?php //echo get_user_meta( $user->ID, 'first_name', true ) ?>
    <?php //echo get_current_user_id(); ?>
    <?php //echo do_shortcode( '[easy-auth-login-form]' ); ?>
</div>
<?php echo the_content(); ?>


<?php
get_footer();