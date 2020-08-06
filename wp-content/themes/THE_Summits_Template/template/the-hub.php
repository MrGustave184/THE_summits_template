<?php
/*
 * Template Name: The Hub
 */

get_header();
?>

<?php while (have_posts()) :

    the_post(); ?>

    <?php
    /*
     * Printing the Header (Banner, Color, Video)
     */
    header_by_ID( get_the_ID() );
    ?>

    <div id="the_hub">
        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php the_field('top_text')?>
                    </div>
                </div>
            </div>
        </div>

		<?php 
		for ($x=1; $x <6 ; $x++) { 
			$idObj = get_category_by_slug("category-$x"); 
			$id = $idObj->term_id;
			$amount = $idObj->category_count;

			//At least one post must have the Category
			if( $amount>0 ) :?>

				<div class="py-3">
					<div class="container-fluid">
						<div class="row d-flex justify-content-start align-items-start" >
							<div class="col-12 text-center py-2 bg-congress main-text-congress">
								<div class="my-1">
									<h2>
										<?php echo $idObj->name; ?>
									</h2>
								</div>
							</div>

								<?php
								$query = new WP_Query( "cat=$id" );
								if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
								
									<div class="col-lg-3 col-12 col-sm-6 p-2">
										<div class="the-hub-card">
											<div>
												<a target="_blank" href="<?php the_field('external_url')?>">
													<? if( get_the_post_thumbnail_url() ) { 
														$image = get_the_post_thumbnail_url(); 
													} else {
														$image = get_template_directory_uri()."/img/no-image.jpg";
													}?> 
													<img class="img-fluid d-block w-100" src="<?php echo $image; ?>">
												</a>
											</div>
											<a target="_blank" class="d-block px-3" href="<?php the_field('external_url')?>">
												<h5 class="my-3 text-center title"><b><?php the_title(); ?></b> </h5>
											</a>
											<div class="d-block px-3 content" style="word-wrap: break-word;"><?php the_content(); ?></div>
											<div class="d-block px-3 text-center pt-2">
												<a target="_blank" href="<?php the_field('external_url')?>"><?php the_field('bottom_text'); ?></a>
											</div>
											<div class="d-block px-3 py-3"><?php the_time('F jS, Y'); ?></div>
										</div>
									</div>
									<?php
									endwhile;
									wp_reset_postdata();
								endif; ?>
						</div>
					</div>
				</div>
			<?php
		endif;
		}// end For
		?>

    </div>

    <div id="speakers-four">
		<?php get_template_part( 'template/partners', 'index' ); ?>
    </div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>