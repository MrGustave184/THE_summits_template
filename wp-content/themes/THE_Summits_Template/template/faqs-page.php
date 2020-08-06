<?php
/*
  * Template Name: FAQS Page (old)
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

        <div id="faqs-two">
            <div class="container">
                <div class="row">
                    <?php
                // loop through the rows of data
                while ( have_rows('faqs_boxes') ) : the_row();

                    if( get_row_layout() == 'faqs_box' ){
                        ?>
                        <div class="col-12 col-sm-12 col-md-4">
                            <a href="<?php the_sub_field('box_url'); ?>">
                                <div class="faq-box">
                                    <img src="<?php the_sub_field('box_image'); ?>">
                                    <div class="faq-text">
                                        <h5> <?php the_sub_field('box_name'); ?> </h5>
                                        <div> <?php the_sub_field('box_text'); ?> </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                <?php 
                    } 
                endwhile;
                ?>
                </div>
            </div>
        </div>

        <div id="three">
            <div class="container">
                <div class="row">
                    <div class="title col-12 col-sm-12">
                        <?php if( get_field('section_three_text') ){ ?>
                            <h3> <?php the_field('section_three_text'); ?></h3>
                            <hr>
                        <?php } ?>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-12 col-sm-12">
                        <?php
                        $link = get_field('section_three_link'); 
                        if($link) { ?>
                            <a class=" btn btn-congress" target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>">
                                <?php echo $link['title']; ?>
                            </a>
                        <?php }?>
                        
                    </div>
                </div>

            </div>
        </div>

        <!-- Newsletter -->
		<div id="eight" class="newsletter-settings">
			<?php get_template_part( 'template/newsletter', 'part' ); ?>
		</div>

        <div id="six">
                <?php get_template_part( 'template/partners', 'index' ); ?>
        </div>

        <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>