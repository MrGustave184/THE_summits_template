<?php
/*
  * Template Name: About Summit
  * */
?>
	<!-- Header Settings -->
<?php get_header(); ?>

<?php while (have_posts()) :
    the_post();
    /*
     * Printing the Header (Banner, Color, Video)
     */
    header_by_ID( get_the_ID() );
    ?>

    <!-- Header Settings -->

	<div id="summit-two">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12">
                    <?php if(get_field('section_two_title')){ ?>
                        <h3 class="text-center"> <?php the_field('section_two_title');?> </h3>
                        <hr>
                    <?php } ?>
				</div><!-- /.row -->   

				<div class="col-12 col-sm-12">
					<p> <?php the_field('section_two_text'); ?> </p>
				</div> 
			</div>
		</div>
	</div>

	<div id="summit-three">
		<div class="container">
			<div class="row p-0">
				<?php for($x = 1; $x < 4; $x++){ ?>
					<div class="col-12 col-sm-12 col-lg-6 p-0">
						<?php if($x != 2){ ?>
                        <?php if(get_field('section_three_'.$x.'_title')){ ?>
                                <h3 class="text-center"> <?php the_field('section_three_'.$x.'_title');?> </h3>
                                <hr>
                            <?php }?>
							<div class="pr-lg-5 text-center text-md-left"> <?php the_field('section_three_'.$x.'_text');?>  </div>
						<?php } else {?>
							<?php if( get_field('section_three_'.$x.'_image') ) { ?>
								<img src="<?php the_field('section_three_'.$x.'_image');?>">
							<?php }?>
						<?php }?>
					</div>
					<div class="col-12 col-sm-12 col-lg-6 p-0">
						<?php if($x != 2){ ?>
							<?php if( get_field('section_three_'.$x.'_image') ) { ?>
								<img src="<?php the_field('section_three_'.$x.'_image');?>">
							<?php }?>
						<?php } else {?>
							<?php if(get_field('section_three_'.$x.'_title')) {?>
                                <h3 class="text-center"> <?php the_field('section_three_'.$x.'_title');?> </h3>
                                <hr>
                            <?php }?>
							<div class="pl-lg-5 text-center text-md-left"> <?php the_field('section_three_'.$x.'_text');?>  </div>
						<?php }?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- Statics -->
	<?php
	if (get_field('statics_background') == 0) {
		$background2 = get_field('statics_color_background');
	} else {
		$bgimg2 = get_field('statics_image_background');
		$background2 = 'URL(' . $bgimg2['url'] . ')';

	} ?>
	<div id="summit-four" style=" background: <?php echo $background2 ?>;
			background-repeat: no-repeat;
			background-position: center center;	
			background-size: cover;">
		<div class="container">
			<div class="row align-items-center text-center">
                <div class="col-12 col-sm-12">
                    <?php if( get_field('statics_title') ){ ?>
                        <h3> <?php the_field('statics_title');?> </h3>
                        <hr>
                    <?php } ?>
                </div>

				<?php for ($x = 1; $x < 4; $x++) {
					?>
					<div class="col-md-4 col-sm-12 col-12 stats">
						<h1 class="description color-congress">
							<strong> <?php the_field('statics_'.$x.'_top'); ?> </strong></h1>
						<h5 class="title"> <?php the_field('statics_'.$x.'_bottom'); ?> </h5>
					</div>

					<?php
				} ?>

			</div>
		</div>
		<!-- container -->
	</div>

	<div id="summit-five">
		<div class="container">
			<div class="row align-items-center">

				<div class="col-12 col-sm-12">
                    <?php if( get_field('section_five_title') ){ ?>
                        <h3 class="text-center"> <?php the_field('section_five_title');?> </h3>
                        <hr>
                    <?php } ?>
					<div> <?php the_field('section_five_text');?>  </div>
				</div>

				<div class="col-md-4 col-sm-12 col-12">
					<a target="_blank" href="<?php the_field('section_five_url_1'); ?>"> <img src="<?php the_field('section_five_image_1'); ?>"> </a>
				</div>

				<div class="col-md-4 col-sm-12 col-12 stats">
					<a target="_blank" href="<?php the_field('section_five_url_2'); ?>"> <img src="<?php the_field('section_five_image_2'); ?>"> </a>
				</div>

				<div class="col-md-4 col-sm-12 col-12 stats">
					<a target="_blank" href="<?php the_field('section_five_url_3'); ?>"> <img src="<?php the_field('section_five_image_3'); ?>"> </a>
				</div>

				<div class="col-12 col-sm-12 mt-5 text-center">

<?php
$link = get_field('section_five_button_url'); 
if($link) { ?>
	<a class="btn btn-congress" target="<?php echo $link['target'];?>" href="<?php echo $link['url'];?>">
		<?php echo $link['title'];?>
	</a>
				
<?php }?>			
					</div>

			</div>
		</div>
		<!-- container -->
	</div>

	<div id="summit-six">
			<?php get_template_part( 'template/partners', 'index' ); ?>
	</div>

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>