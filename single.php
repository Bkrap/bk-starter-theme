<?php get_header(); ?>

<?php 
$post_info = get_field( 'post_info', get_the_ID() ); 

$filter_args = array(
    "class"     => "go-to-news-index"
);
get_partial('news_filter', $filter_args); 

$cat_arr = array();
foreach( get_the_category() as $k => $v ) {
    $cat_arr[] = $v->term_id;
}

$rel_args_arr = array(
    'query_args' => array(
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => 3,
        'category__in'      => $cat_arr,
        'orderby'           => 'date',
        'order'             => 'DESC',
    ),
    'categories' => get_the_category(),
);

// debug(get_the_category());

$args_arr = array(
    'img_id'        => get_post_thumbnail_id(),
    'category'      => get_the_category()[0]->name,
    'date'          => get_the_date( 'F j, Y', get_the_ID() ),
    'title'         => get_the_title(),
    'author'        => get_the_author(),
);

get_partial( 'single-post/hero', $args_arr );
?>

<section class="post-content">
    <div class="container">
        <div class="row">
            <div class="offset-lg-1 col-lg-6 content">
                <?php echo wpautop( the_content() ); ?>
            </div>
            <?php get_partial( 'single-post/related_posts', $rel_args_arr ); ?>
        </div>
    </div>
</section>

<?php 

// $video_block    = get_field( 'post_info', get_the_ID() )['video_block'];

// if( $video_block['video_source'] == 'video_hub' ) {

//     if( $video_block['video_hub'] ) {

//         $top_label      = get_the_terms( $video_block['video_hub'][0]->ID, "video-category" )[0]->name;
//         $text           = $video_block['video_hub'][0]->post_title; 
//         $title          = wyswig_raw( THEME_OPTIONS['news']['video_block']['title'] );
//         $button         = THEME_OPTIONS['news']['video_block']['button_group']['button'];
//         $image          = wp_get_img_focus_element( get_post_thumbnail_id( $video_block['video_hub'][0]->ID ), 0, 0, 'logo' );
//         $video          = "";

//     } else {

//         $top_label      = THEME_OPTIONS['video_block']['top_label'];
//         $text           = THEME_OPTIONS['video_block']['text'];
//         $title          = wyswig_raw( $video_block['external']['title'] );
//         $image          = wp_get_img_focus_element( THEME_OPTIONS['video_block']['image'] , '50', '50', 'logo' );
//         $button         = THEME_OPTIONS['news']['video_block']['button_group']['button'];

//     }

// } elseif( $video_block['video_source'] == 'external_youtube_video' ) {

//     $top_label      = $video_block['external']['small_title'];
//     $text           = $video_block['external']['excerpt'];
//     $title          = wyswig_raw( $video_block['external']['title'] );
//     $image          = wp_get_img_focus_element( $video_block['external']['image']['id'] , $video_block['external']['image']['left'], $video_block['external']['image']['top'], 'logo' );
//     $button         = $video_block['external']['button_group']['button'];

// } else {

    $top_label      = THEME_OPTIONS['news']['video_block']['pretitle_label'];
    $text           = THEME_OPTIONS['news']['video_block']['text'];
    $title          = wyswig_raw( THEME_OPTIONS['news']['video_block']['title'] );
    $image          = wp_get_img_focus_element( THEME_OPTIONS['news']['video_block']['image'] , '50', '50', 'logo' );
    $button         = THEME_OPTIONS['news']['video_block']['button_group']['button'];

// }

// debug( $video_block );

$video_args = array(
    "top_label"     => $top_label,
    "title"         => $title,
    "text"          => $text,
    "button_group"  => array( 'button' => $button ),
    "image"         => $image,
);
// $video_args['button_group']['button']['function'] = 'url';

/**
 * NASTAVIT:
 * youtube ako je video hub mora voditi na video hub index page i playati video direkt na stranici toj
 * nastavi postavljati btn za video hub
 */
// debug( $video_block );
// debug( $video_args );

get_component_template( 'argo_on_youtube', (array)$video_args );
?>

    <div class="modal fade" id="closedContentModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="closedContentModalLabel" aria-hidden="false">
        <div class="modal-dialog container">
            <div class="row align-items-center no-slider">
                <div class="col-lg-7 text-wrapper">
                    <div class="d-flex align-items-center">
                        <div class="circle"></div>
                        <div class="discount-pill">-100% OFF</div>
                        <p class="mb-0 small-text italic"><?php echo $membership_group['content']['top_label']; ?></p>
                    </div>
                    <h2 class="title"><?php echo wyswig_raw( $membership_group['content']['title'] ); ?></h2>
                    <p class="description"><?php echo $membership_group['content']['description']; ?></p>
                    <form action="">
                        <input type="email" name="email" placeholder="youremail@email.com" required id="">
                        <button type="submit" class="btn btn-primary">Join Argo</button>
                    </form>
                </div>
                <div class="col-lg-5 images-wrapper d-none d-lg-block">
                    <?php echo wp_get_img_focus_element( $membership_group['image']['id'], 0, 0, 'person' ); ?>
                </div>
            </div>
        </div>
    </div>
	
<?php get_footer(); ?>