<?php
/*
  * Template Name: FAQS Page
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
	
	<?php if ( have_content() ) : ?>
		 <div class="pt-5">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>


        <div id="faqs-two">
            <div class="container">
                <div id="accordion">
				<?php 
					if( have_rows('section') ) : 
						//This help us assign a different ID to each card
						$sentinel = '0';
						while( have_rows('section') ) : the_row();		
				?>
				<div class="row">
                    <div class="col-12 col-sm-12 mb-5">
                        <h4 class="accordion-title text-center mb-0 bg-congress main-text-congress">
                            <?php the_sub_field('section_title'); ?>
                        </h4>
                        
						<?php 
							if( have_rows('questions') ) :
								while( have_rows('questions') ) : the_row();
						?>

                            <div class="card border-congress">
                                <div class="card-header" id="header<?php echo $sentinel; ?>">
                                    <h5 class="mb-0">
                                        <a class="btn btn-link" data-toggle="collapse" href="#question<?php echo $sentinel; ?>" aria-expanded="true" aria-controls="question<?php echo $sentinel; ?>" style="text-decoration:none;">
                                            <?php the_sub_field('question_title'); ?>
                                        </a>
                                    </h5>
                                </div>

                                <div id="question<?php echo $sentinel; ?>" class="collapse" aria-labelledby="header<?php echo $sentinel; ?>" data-parent="#accordion">
                                    <div class="card-body">
                                       <?php the_sub_field('question_answer'); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
								$sentinel++;
							 endwhile;
                            	endif;
                           
                            ?>
                        
                    </div>
					</div>
					<?php
					endwhile;
						endif;
					?>
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