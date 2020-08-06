<?php 
/*
*
* Template Name: Speaking
*
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
		
		<div id="two">

			<div class="container">
				<div class="col-12 col-sm-12">
					<?php the_field("text"); ?>
				</div>
			</div>
		</div>

<div id="two">
		 <div class="container">

			<div class="row">
				<div class="col-12 col-sm-12">
					
				<?php get_template_part( 'template/part', 'spinner' ); ?>
                <?php the_field("register_form_url"); ?>
			</div>

		</div>
	</div>
		</div>
		
		<div id="six">
				<?php get_template_part( 'template/partners', 'index' ); ?>
		</div>

	<?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>