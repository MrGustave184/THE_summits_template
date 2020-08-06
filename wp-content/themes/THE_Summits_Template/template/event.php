<?php
/*
*
* Template Name: event 
*
*/?>

<?php get_header(); ?>

    <?php while (have_posts()) :

        the_post(); ?>

        <!-- Header Settings -->

        <?php
        /*
        * Printing the Header (Banner, Color, Video)
        */
        header_by_ID( get_the_ID() );
        ?>

    <!-- Header Code -->

        <?php
            if( get_field('sections_order') ) :

                // Pull the sections array from the backend
                $orderArray = get_field('sections_order');

                // Order the array by the numeric value defined by the user
                asort($orderArray, 1);

                // Print each section dinamically in the desired order
                
                // Before calling template part, we can check if the section if enabled here and not in the template part
                foreach( $orderArray as $section => $order ) {
                    // if (get_field('enable_' . $section))
                    get_template_part('template/event_sections/event', $section);
                }

            endif;
        ?>
    <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>