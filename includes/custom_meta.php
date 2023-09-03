<?php

function register_primary_category_meta() {
    register_meta( 'post', 'primary_category', [
        'type' => 'integer',
        'single' => true,
        'sanitize_callback' => 'absint'
    ] );
}
add_action( 'init', 'register_primary_category_meta' );

function add_primary_category_metabox() {
    add_meta_box( 'primary_category_metabox', 'Primary Category', 'render_primary_category_metabox', 'post', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'add_primary_category_metabox' );

function render_primary_category_metabox( $post ) {
    $primary_category = get_post_meta( $post->ID, 'primary_category', true );
    $categories = get_categories( [
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false
    ] );
    ?>
        <label for="primary_category">Select primary category:</label>
        <select name="primary_category" id="primary_category">
            <option value="">-- None --</option>
            <?php foreach ( $categories as $category ) : ?>
                <option value="<?php echo $category->term_id; ?>" <?php selected( $category->term_id, $primary_category ); ?>><?php echo $category->name; ?></option>
            <?php endforeach; ?>
        </select>
    <?php
}