<?php
/*
  * Template Name: Hosting
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

		<!-- Home Statics -->
		<?php
		if (get_field('statics_background') == 0) {
			$background2 = get_field('statics_background_color');
		} else {
			$bgimg2 = get_field('statics_background_image');
			$background2 = 'URL(' . $bgimg2 . ')';

		} ?>
		<div id="two" style=" background: <?php echo $background2 ?>;
				background-repeat: no-repeat;
				background-position: center center;

				background-size: cover;">
			<div class="container">
				<div class="row align-items-center text-center">

					<?php for ($x = 1; $x < 4; $x++) {
						?>
						<div class="col-md-4 col- col-sm-12 stats">
							<h1 class="description color-congress">
								<strong> <?php the_field('statics_top_'. $x); ?> </strong></h1>
							<h5 class="title"> <?php the_field('statics_bottom_'. $x); ?> </h5>
						</div>

						<?php
					} ?>

				</div>
			</div>
			<!-- container -->
		</div>

		<div id="three">
			<div class="container">
				<div class="row text-center">
					<div class="title col- col-sm-12">
                        <?php if( get_field('section_3_title') ){ ?>
                            <h3> <?php the_field('section_3_title'); ?></h3>
                            <hr>
						<?php }?>
					</div>
				</div>
				<div class="row text-center">
					<div class="col- col-sm-12">
						<?php the_field('section_3_text'); ?>
					</div>
				</div>

			</div>
		</div>

		<div id="four">
			<div class="container">
				<div class="row text-center">
					<div class="title col- col-sm-12">
                        <?php if( get_field('section_4_title') ){ ?>
                            <h3> <?php the_field('section_4_title'); ?></h3>
                            <hr>
						<?php } ?>
					</div>
				</div>
				<div class="row text-center">
					<div class="col- col-sm-12">
						<?php the_field('section_4_text'); ?>
					</div>
				</div>

				<div class="row text-center">
					<div class="col- col-sm-12">
						<img src="<?php the_field('section_4_image'); ?>">
					</div>
				</div>

			</div>
		</div>

		<?php
		if (get_field('section_five_background') == 1) {
			$background5 = get_field('section_five_color_background');
		} else {
			$bgimg5 = get_field('section_five_image_background');
			$background5 = 'URL(' . $bgimg5 . ')';
		} ?>
		<div id="six" style=" background: <?php echo $background5 ?>;
				background-repeat: no-repeat;
				background-position: center center;

				background-size: cover;">
			<div class="container">
				<div class="row text-center">
					<div class="col-12 col-sm-12">
						<h5> <?php the_field('section_five_content'); ?> </h5>
					</div>
				</div>
			</div>
			<!-- container -->
		</div>

	<div id="sponsorship-six">
		 <div class="container">
			<div class="row text-center">
				<div class="title col-12 col-sm-12">
                    <?php if( get_field('section_six_title') ){ ?>
                        <h3><?php the_field('section_six_title'); ?></h3>
                        <hr>
					<?php } ?>
				</div>
			</div>


			<div class="row text-center">
				<div class="col-12 col-sm-12">
					<a class="btn btn-congress" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
						<h5><?php the_field('section_six_button_text');?></h5>
					</a>


					<div class="collapse position-relative" id="collapseExample">
					<?php get_template_part( 'template/part', 'spinner' ); ?>
                    <?php the_field('form_url');?>
					</div>
					
				</div>
			</div>

		</div>
	</div>

		<div id="hostpartner-seven">
				<?php get_template_part( 'template/partners', 'index' ); ?>
		</div>

		<?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>