<?php

/**
 * Template name: Integration - EventBrite
 */
?>

<?php 
 get_header(); 
while (have_posts()) :

    the_post(); ?>

    <?php
    /*
     * Printing the Header (Banner, Color, Video)
     */
    header_by_ID( get_the_ID() );
    ?>

    <div id="five-terms">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
    
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php the_field('code_to_integrate'); ?>
                </div>
            </div>
        </div>
    </div>


    <div id="six">
            <?php get_template_part( 'template/partners', 'index' ); ?>
        
    </div>

<?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>