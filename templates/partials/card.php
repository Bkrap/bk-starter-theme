<?php //debug($params); ?>
<div class="col-lg-4 card-column grid-card">
    <div class="card h-100">
        <div class="image-wrapper">
            <?php if( isset( $params['primary_category'] ) ) { ?>
                <div class="category-pill">
                    <p class="mb-0 bold-text"><?php echo $params['primary_category']; ?></p>
                </div>
            <?php } ?>
        </div>
        <div class="card-body">
            <p class="date mb-0"><?php echo get_the_date( "j F Y", $params['ID'] ); ?></p>
            <h5 class="card-title bold-text"><?php echo $params['post_title']; ?></h5>
            <p class="card-text mb-0"><?php echo check_post_excerpt( $params['ID'] ); ?></p>
        </div>
        <div class="card-footer d-flex align-items-center">
            <p class="link-text mb-0">Read more</p>
        </div>
        <a href="<?php echo get_permalink($params['ID']); ?>"></a>
    </div>
</div>