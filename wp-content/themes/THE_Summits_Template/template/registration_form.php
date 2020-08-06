<?php 

/*
* Template name: Registration Forms
*/

get_header(); ?>

<?php while (have_posts()) :

the_post(); 

    /*
     * Printing the Header (Banner, Color, Video)
     */
    header_by_ID( get_the_ID() );
?>
     <div class="container-fluid">
			<div class="row text-center">
				<div class="col-12 col-sm-12 position-relative">
					<?php get_template_part( 'template/part', 'spinner' ); ?>
						<?php
							$form = get_field('register_form_url');
							echo do_shortcode("[iframe src=\"$form\" height='1500px']");
						?>
			</div>
		</div>
	</div>

 <?php endwhile;
get_footer(); ?>