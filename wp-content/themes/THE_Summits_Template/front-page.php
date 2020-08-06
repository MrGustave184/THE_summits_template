<?php get_header(); ?>

<?php while (have_posts()) :

the_post(); ?>

<?php
    /*
     * Printing the Header (Banner, Color, Video)
     */
    header_by_ID( get_the_ID() );
?>

<!-- Statistics Section -->
<?php
if (get_field('enable_statistics') ) {
	// vars
	$hero = get_field('statistics_group');	

	if( $hero ){ ?>
		<div id="two">
			<div class="container">
				<div class="row align-items-center text-center">
					<?php for ($x = 1; $x < 5; $x++) {
						?>
						<div class="col-md-3 col-sm-6 col-12 col-sm-12 stats">
							<h1 class="description color-congress">
								<strong> <?php echo $hero['statics_description_' . $x]; ?> </strong></h1>
							<h5 class="title"> <?php echo $hero['statics_title_' . $x]; ?> </h5>
						</div>
						<?php
					} ?>
				</div>
			</div>
		</div>
		<?php
	}

	if ($hero['statics_background'] == 0) {
		$background2 = $hero['statics_background_color'];
	} else {
		$bgimg2 = $hero['statics_background_image'];
		$background2 = 'URL(' . $bgimg2 . ')';
	} ?>

	<style type="text/css">
		#two {
			background: <?php echo $background2; ?>;
			background-position: center center;
			background-size: cover;
			background-repeat: no-repeat;
		}
	</style>

		<?php 
}//Enable Statistics ?>
<!--Statistics Section Close-->


<!-- Section Three -->
		<div id="three">

			<div class="container">

				<div class="row">

					<div class="title col-12 col-sm-12">
                        <?php if(get_field('section_3_title')){ ?>
                            <h3> <?php the_field('section_3_title'); ?></h3>
                            <hr>
                        <?php } ?>
					</div>

				</div>

				<div class="row">

					<div class="col-12 col-sm-12">

						<?php the_field('section_3_text'); ?>

					</div>

				</div>



			</div>

		</div>
	<!-- Section Three -->

<!-- Speaker Section -->
<?php
if(get_field('enable_speakers')) {
    // vars
    $hero = get_field('speakers_group');

    if( $hero ){ ?>
        <div id="four">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12 col-sm-12">
                        <?php if($hero['speakers_section_title']) { ?>
                            <h3> <?php echo $hero['speakers_section_title']; ?> </h3>
                            <hr>
                        <?php } ?>
                    </div>

                    <div class="col-12 col-sm-12 pb-4">
                        <?php echo $hero['speakers_section_sub-title']; ?>
                    </div>
					
					<?php
					//sending the amount of Speakers for the Front Page Section
					//set_query_var( 'speakers_section_amount', $hero['speakers_section_amount'] );
					?>

                    <?php get_template_part('template/speakers', 'index'); ?>
					
					<?php 

					$link = $hero['speakers_section_button'];

					if( $link ): ?>
					<div class="col-12 col-sm-12">
						<a class="btn btn-congress" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
							<?php echo $link['title']; ?>
						</a>
					</div>

					<?php endif; ?>

                    
                </div>
            </div>
        </div>
        <?php
    }
}//Enable Speakers
?>
<!-- Speaker Section CLOSE -->




    <!-- Testimonials Section -->
    <?php
    if (get_field('enable_testimonials') ) {
        // vars
        $hero = get_field('testimonials');

        if( $hero ){ ?>
            <div id="five" class="bg-congress main-text-congress p-0">
                <div class="container-fluid p-0">
                    <div class="row no-gutters text-center">
                        <link rel="stylesheet"
                              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                        <div class="col-12 col-md-12 col-lg-6">
                            <img src="<?php echo $hero['quotes_img_1']; ?>" alt="quotes-01">
                        </div>

                        <div class="col-12 col-md-12 col-lg-3 px-3 px-lg-1 px-xl-5 my-5">
                            <h1><i class="fa fa-quote-left"></i></h1>
                            <p> <?php echo $hero['quotes_text_1']; ?> </p>
                        </div>

                        <div class="col-12 col-md-12 col-lg-3">
                            <img src="<?php echo $hero['quotes_img_2']; ?>" alt="quotes-02">
                        </div>

                        <div class="col-12 col-md-12 col-lg-3 px-3 px-lg-1 px-xl-5 my-5">
                            <h1><i class="fa fa-quote-left"></i></h1>
                            <p> <?php echo $hero['quotes_text_2']; ?> </p>
                        </div>

                        <div class="col-12 col-md-12 col-lg-6">
                            <img src="<?php echo $hero['quotes_img_3']; ?>" alt="quotes-03">
                        </div>

                        <div class="col-12 col-md-12 col-lg-3 px-3 px-lg-1 px-xl-5 my-5">
                            <h1><i class="fa fa-quote-left"></i></h1>
                            <p> <?php echo $hero['quotes_text_3']; ?> </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    <?php }?>
    <!--Statistics Section Close-->

		<div id="six">

			<div class="container">

				<?php get_template_part( 'template/partners', 'index' ); ?>

			</div>

		</div>



		<!-- Global Partners EXECUTION -->

		<hr class="meta-border">


		<!-- Features Articles EXECUTION -->

		<div id="seven">

			<div class="container">

                <div class="row text-center">

                    <div class="col-12 col-sm-12">
                        <?php if(get_field('articles_sections_title')) { ?>
                            <h3> <?php the_field('articles_sections_title');?> </h3>
                            <hr>
                        <?php } ?>
                    </div>

                </div>

				<?php get_template_part( 'template/loop', 'index' ); ?>

			</div>

		</div>

		<!-- Newsletter -->
		<div id="eight" class="newsletter-settings">
			<?php get_template_part( 'template/newsletter', 'part' ); ?>
		</div>

        <!-- Timelines -->
		<?php get_template_part( 'template/timeline', 'part' ); ?>

		<?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>