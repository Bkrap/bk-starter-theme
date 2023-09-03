<section class="hero-module">
    <div class="hero" style="background-image: url('<?php echo wp_get_attachment_image_url( $params['image']['id'], 'full' ); ?>');">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 text-wrapper">
                    <?php if( $params['title'] ) { ?>
                        <h1 class="heading"><?php echo $params['title']; ?></h1>
                    <?php } ?>
                    <?php if( $params['text'] ) { ?>
                        <p class="description"><?php echo $params['text']; ?></p>
                    <?php } ?>
                    <?php if( $params['button_group']['show_button'] ) {
                        echo get_btn( $params['button_group'] ); // pass the button group array to the get_btn function
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>

