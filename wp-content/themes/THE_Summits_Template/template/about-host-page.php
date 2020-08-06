<?php 
/*
* Template Name: About Host
*/?>
<?php get_header(); ?>

<?php while (have_posts()) :

    the_post(); ?>

    <?php
    /*
     * Printing the Header (Banner, Color, Video)
     */
    header_by_ID( get_the_ID() );
    ?>

		<div id="about-host-two">
			<div class="container">
				<div class="row text-center">
					<div class="col-12 col-sm-12">
                        <?php if(get_field('section_2_title')){ ?>
                            <h3> <?php the_field('section_2_title'); ?></h3>
                            <hr>
                        <?php } ?>
					</div>

					<div class="col-12 col-sm-12">
						<div class="host-avatar"><img src="<?php the_field('section_2_image'); ?>"></div>
						<div> <?php the_field('section_2_content'); ?> </div>
					</div>
				</div>						
			</div>
		</div>

		<div id="about-host-three">
			<div class="container">
				<div class="row text-center">
					<div class="col-12 col-sm-12">
                        <?php if(get_field('section_3_title')){ ?>
                            <h3> <?php the_field('section_3_title'); ?></h3>
                            <hr>
                        <?php }?>
					</div>

					<div class="col-12 col-sm-12">
						<div><img src="<?php the_field('section_3_image'); ?>"></div>
						<div> <?php the_field('section_3_content'); ?> </div>
					</div>
				</div>						
			</div>
		</div>

		<!-- Global Partners EXECUTION -->
		<div id="six">
			<?php get_template_part( 'template/partners', 'index' ); ?>
		</div>


		<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
