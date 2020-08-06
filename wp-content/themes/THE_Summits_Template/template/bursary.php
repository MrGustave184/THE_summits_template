<?php 
/*
*
* Template Name: Bursary
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
		<div class="row">
			<div class="col-12 col-sm-12 text-center">
                <?php if( get_field('section_title') ){ ?>
                    <h3><?php the_field('section_title'); ?></h3>
                    <hr>
                <?php } ?>
			</div>
			<div class="col-12 col-sm-12">
				<?php the_field('general_content'); ?>
			</div>
		</div>
	</div>
</div>

<div id="sponsorship-six">
		 <div class="container">

			<div class="row text-center">
				<div class="col-12 col-sm-12">
					<a class="btn btn-congress" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
						<h5><?php the_field('form_button_text');?></h5>
					</a>

					<div class="collapse position-relative" id="collapseExample">
						<?php get_template_part( 'template/part', 'spinner' ); ?>
                        <?php the_field('form_url');?>
					</div>
				</div>
			</div>

		</div>
	</div>


<div id="speakers-four">
	<?php get_template_part( 'template/partners', 'index' ); ?>
</div>
	<?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>