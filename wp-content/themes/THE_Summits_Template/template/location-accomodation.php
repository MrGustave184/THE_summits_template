<?php
/*
  * Template Name: Location Accomodation
  * */
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

	<div id="summit-three">
		<div class="container">
            <div class="row text-center">
                <div class="col-12 col-sm-12">
                    <?php if( get_field('section_three_main_title') ){ ?>
                            <h3> <?php the_field('section_three_main_title');?> </h3>
                            <hr>
                    <?php } ?>
                </div>
            </div>
			<div class="row p-0 text-center">
				<?php for($x = 1; $x < 3; $x++){ ?>
					<div class="col-12 col-sm-12 col-lg-6 p-0">
						<?php if($x %2 != 0){ ?>
                            <?php if( get_field('section_three_'.$x.'_title') ) { ?>
									<h3> <?php the_field('section_three_'.$x.'_title');?> </h3>
									<hr>
                            <?php } ?>
							<div class="p-5 p-sm-0 pr-sm-5"> <?php the_field('section_three_'.$x.'_text');?>  </div>
						<?php } else {?>
							<div class="venue-map"> <?php the_field('section_three_'.$x.'_image');?> </div>
						<?php }?>
					</div>
					<div class="col-12 col-sm-12 col-lg-6 p-0">
						<?php if($x %2 != 0){ ?>
							<img src="<?php the_field('section_three_'.$x.'_image');?>">
						<?php } else { ?>
                            <?php if( get_field('section_three_'.$x.'_title') ) { ?>
                                <h3> <?php the_field('section_three_'.$x.'_title');?> </h3>
                                <hr>
                            <?php } ?>
							<div class="pl-5"> <?php the_field('section_three_'.$x.'_text');?>  </div>
						<?php }?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

        <div id="accomodation-four">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 text-center text-sm-left">
                        <h3> <?php the_field('section_four_main_title'); ?> </h3>
                    </div>
                    <div class="col-12 col-sm-12 text-left">
                        <?php the_field('section_four_content'); ?>
                    </div>
                </div>
            </div>
        </div>

	<div id="summit-six">
			
				<?php get_template_part( 'template/partners', 'index' ); ?>
			
		</div>

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
