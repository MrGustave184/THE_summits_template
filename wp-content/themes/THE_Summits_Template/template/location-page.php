<?php
/*
  * Template Name: Location Page
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
			<div class="row p-0 text-center">
				<?php for($x = 1; $x < 5; $x++){ ?>
					<div class="col-12 col-sm-12 col-lg-6 p-0">
						<?php if($x %2 != 0){ ?>
                            <?php if( get_field('section_three_'.$x.'_title') ) { ?>
                                <h3> <?php the_field('section_three_'.$x.'_title');?> </h3>
                                <hr>
                            <?php } ?>
							<div> <?php the_field('section_three_'.$x.'_text');?>  </div>
						<?php } else {?>
							<img src="<?php the_field('section_three_'.$x.'_image');?>">
						<?php }?>
					</div>
					<div class="col-12 col-sm-12 col-lg-6 p-0">
						<?php if($x %2 != 0){ ?>
							<img src="<?php the_field('section_three_'.$x.'_image');?>">
						<?php } else {?>
                            <?php if( get_field('section_three_'.$x.'_title') ) { ?>
                                <h3> <?php the_field('section_three_'.$x.'_title');?> </h3>
                                <hr>
                            <?php } ?>
							<div> <?php the_field('section_three_'.$x.'_text');?>  </div>
						<?php }?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div id="summit-six">
			<div class="container">
				<?php get_template_part( 'template/partners', 'index' ); ?>
			</div>
		</div>

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
