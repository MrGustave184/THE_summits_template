<?php
/*
  * Template Name: FAQS Single
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
                    <div class="col-12 col-sm-12">
                        <h4 class="accordion-title text-center mb-0 bg-congress main-text-congress">
                            <?php the_field('questions_title'); ?>
                        </h4>
                        <div id="accordion">
                            <?php
                            // loop through the rows of data
                            $cont=1;
                            while ( have_rows('faqs_questions') ) : the_row();

                            if( get_row_layout() == 'question' ){
                            ?>

                            <div class="card border-congress">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?php echo $cont?>" aria-expanded="true" aria-controls="collapse-<?php echo $cont?>">
                                            <?php the_sub_field('box_question');?>
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapse-<?php echo $cont?>" class="collapse" aria-labelledby="heading-<?php echo $cont?>" data-parent="#accordion">
                                    <div class="card-body">
                                        <?php the_sub_field('box_answer');?>
                                    </div>
                                </div>
                            </div>

                                <?php
                                $cont = $cont+1;
                            }
                            endwhile;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="three">
            <div class="container">
                <div class="row text-center">
                    <div class="title col- col-sm-12">
                        <?php if( get_field('section_three_text') ){ ?>
                            <h3> <?php the_field('section_three_text'); ?></h3>
                            <hr>
                        <?php } ?>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col- col-sm-12">
                        <?php
                        $link = get_field('section_three_link');
                            if($link) { ?>
                            <a class=" btn btn-congress" target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>">
                                <?php echo $link['title']; ?>
                            </a>
                        <?php } ?>
                        
                        
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