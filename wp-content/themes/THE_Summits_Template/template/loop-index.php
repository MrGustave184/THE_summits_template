<div class="row">
    <!-- Start the Loop. -->
    <?php
    $idObj = get_category_by_slug("front-page"); 
	$id = $idObj->term_id;
    global $wp_query;
    $wp_query = new WP_Query("post_type=post&posts_per_page=3&offset=0&post_status=publish&order=desc&cat=$id");
    while ($wp_query->have_posts()) { $wp_query->the_post(); ?>

        <div class="col-12 col-sm-12 col-md-4 text-center">
            <!-- Display the Post Thumbnail -->
            <div class="mb-1">
                <a href="<?php the_field('external_url'); ?>" target="_blank">
                    <img class="img-fluid mx-auto d-block" src="<?php the_post_thumbnail_url(); ?>" alt="post-thumbnail-<?php echo $cont; $cont = $cont+1; ?>">
                </a>
            </div>
            <!-- Display the Title as a link to the Post's permalink. -->
            <h4>
                <a  target="_blank" class="color-congress" href="<?php the_field('external_url'); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </h4>

            <!-- Display the Post's content in a div box. -->
            <div class="entry">
                <div>
                    <?php the_content(); ?>
                </div>
                <a href="<?php the_field('external_url'); ?>"  target="_blank">...Read More</a>
            </div>

            <!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
            <div class="text-center">
                <small><?php the_time('l, F j, Y'); ?> at <?php the_time('g:i a');?></small>
            </div>
        </div>


        <?php

    }; wp_reset_query();
    ?>
</div>