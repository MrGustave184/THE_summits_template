<?php
/*
  * Template Name: Download App
  *
 */
?>
<?php get_header(); ?>

<?php while (have_posts()) :

    the_post(); ?>

    <?php
    /*
     * Printing the Header (Banner, Color, Video)
     */
    header_by_ID( get_the_ID() );
    ?>

        <div id="download-two">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12 col-sm-12">
                        <h3> <?php the_field('section_two_title'); ?> </h3>
                    </div>
                    <div class="col-12 col-sm-12">
                        <h3> <?php the_field('section_two_sub_title'); ?> </h3>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="square align-items-center" style="background-color: <?php the_field('section_two_image_left_background_color'); ?>">
                            <a href="<?php the_field('section_two_image_left_url'); ?>"> <img src="<?php the_field('section_two_image_left'); ?>" alt="download-img-1"> </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="square" style="background-color: <?php the_field('section_two_image_right_background_color'); ?>">
                            <a  href="<?php the_field('section_two_image_right_url'); ?>"> <img src="<?php the_field('section_two_image_right'); ?>" alt="download-img-2"> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="download-three">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12 col-sm-12">
                        <h3> <?php the_field('section_three_title'); ?> </h3>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div> <?php the_field('section_three_sub_title'); ?> </div>
                    </div>
                    <div class="col-12 col-sm-12">
                            <a class="btn btn-congress" href="<?php the_field('section_three_button_url'); ?>"> <?php the_field('section_three_button_text'); ?> </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="six">
            <div class="container">
                <?php get_template_part( 'template/partners', 'index' ); ?>
            </div>
        </div>



        <?php endwhile; // end of the loop. ?>

        <?php get_footer(); ?>