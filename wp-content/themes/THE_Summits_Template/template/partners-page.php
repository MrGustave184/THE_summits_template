<?php
/*
  * Template Name: Partners
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

<div id="partners-two">
    <div class="container">
        <?php
        global $wp_query; $cont=1;
        $wp_query = new WP_Query("post_type=partners&posts_per_page=0&offset=1&post_status=publish&order=asc");
        while ($wp_query->have_posts()) { $wp_query->the_post(); ?>

            <!-- Row Partners -->
            <div class="row text-center py-sm-5 justify-content-center">
                <div class="col-12 col-sm-12">
                    <?php if( get_field('section_label') ) { ?>
                        <h3><?php the_field('section_label'); ?></h3>
                        <hr>
                    <?php } ?>
                </div>

                <?php
                // loop through the rows of data
                while ( have_rows('sections_partners') ) : the_row();

                    if( get_row_layout() == 'new_partner' ){
                        ?>
                        <div class="col-12 col-sm-4 partner">
                            <!-- Button trigger modal -->
                            <a class="" data-toggle="modal" data-target="#partnerModal<?php echo $cont; ?>">
                                <div> <img src="<?php the_sub_field('image'); ?>" alt="partner-<?php echo $cont; ?>"> </div>
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="partnerModal<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="partnerModalLabel<?php echo $cont; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div> <img src="<?php the_sub_field('image'); ?>" alt="partner-<?php echo $cont; ?>"> </div>
                                            <div><?php the_sub_field('description'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    } $cont = $cont+1;
                endwhile;
                ?>

            </div>
            <!-- Row Partners -->
            <?php

        }; wp_reset_query();
        ?>
    </div>
</div>

<hr class="meta-border">

<div id="partners-three">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div><?php the_field('section_two_text'); ?></div>
            </div>

            <?php
            $link = get_field('section_two_button_link');
            if($link){ ?>
                <div class="col-12 col-sm-12 text-center">
                    <a class="btn btn-congress" target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>">
                        <?php echo $link['title']; ?>
                    </a>
                </div>
            <?php } ?>
            
        </div>
    </div>
</div>

    <?php endwhile; // end of the loop. ?>

    <?php get_footer(); ?>