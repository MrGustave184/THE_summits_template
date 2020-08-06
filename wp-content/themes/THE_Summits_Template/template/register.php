<?php
/*
  * Template Name: Register
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

<!-- Section Two NEW REGISTER -->
		<div id="three-register">

			<div class="container w-md-75 w-lg-50 py-5">
				<div class="row text-center text-uppercase">
					<div class="col-12 col-sm-4 border-right border-secondary 
								<?php if(get_field('active_main_title') == 1) echo 'font-weight-bold text-e83e8c';?> ">
						<?php the_field('register_head_title_1');?>
					</div>
					<div class="col-12 col-sm-4 border-right border-secondary py-2 py-sm-0
								<?php if(get_field('active_main_title') == 2) echo 'font-weight-bold  text-e83e8c';?> ">
						<?php the_field('register_head_title_2');?>
					</div>
					<div class="col-12 col-sm-4
								<?php if(get_field('active_main_title') == 3) echo 'font-weight-bold  text-e83e8c';?> ">
						<?php the_field('register_head_title_3');?>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row text-center">

					<div class="col-6 offset-3 text-center">
						<label class="switch align-middle mr-3">
							<input type="checkbox" onclick="bait()">
							<span class="slider round align-middle"></span>
						</label>
						<label class="align-middle text-uppercase"><?php the_field('register_switch_button_text'); ?></label>

						<!-- Bait is the Trigger to execute the dropdown-->
						<a hidden data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" 
						aria-controls="multiCollapseExample1 multiCollapseExample2 multiCollapseExample3" id="bait"></a>
					</div>
					
				</div>
			</div>

			<script type="text/javascript">
				function bait(){
					document.getElementById('bait').click();
				}
				
			</script>

			<div class="container">
				<div class="row text-center">
					
					<div class="col-12 col-lg-4 py-4 py-lg-0">
						<div class="container-fluid border border-cbcbcb">
							<div class="row">

								<div class="col-12 pt-2 text-uppercase bg-congress main-text-congress">
									<h4 class="d-inline align-middle"> <?php the_field('register_box_title_1'); ?> </h4>
									<h6 class="small"> <?php if(get_field('main_subtitle_1')) the_field('main_subtitle_1'); else echo '&emsp14;'; ?> </h6>
								</div>
								<div class="col-12 border-bottom border-secondary mb-2 py-2">
									<h1> <?php the_field('top_price_1'); ?> </h1>
								</div>

								<div class="col-12 py-1 col-sm-6 border-right border-secondary">
									<h6 class="mb-0 text-secondary text-uppercase"><?php if(get_field('left_price_top_1')) the_field('left_price_top_1'); else echo '&emsp14;'; ?></h6>
                                    <small class="text-secondary text-uppercase"><?php if(get_field('left_price_top_1')) the_field('left_price_valid_1'); else echo '&emsp14;'; ?></small>
									<h4><strong><?php the_field('left_price_1');?></strong></h4>
								</div>
								<div class="col-12 py-1 col-sm-6 min-lg-h100">
									<h6 class="mb-0 text-secondary text-uppercase"><?php if(get_field('right_price_top_1')) the_field('right_price_top_1'); else echo '&emsp14;'; ?></h6>
                                    <small class="text-secondary text-uppercase"><?php if(get_field('right_price_top_1')) the_field('right_price_valid_1'); else echo '&emsp14;'; ?></small>
									<h4><strong><?php the_field('right_price_1');?></strong></h4>
								</div>
								<div class="col-12 px-0">
									<div class="collapse multi-collapse" id="multiCollapseExample1">
										<div class="">
											<?php
											$cont = 0;
												if( have_rows('description_rows_1') ):
													while ( have_rows('description_rows_1') ) : the_row();
														if( get_row_layout() == 'row' ):
															if($cont%2 == 0){ echo '<p class="bg-EC px-2">'; }else{ echo '<p class="px-2">'; }
															the_sub_field('description');
															echo '</p>';
															$cont = $cont + 1;
														endif;
													endwhile;
												endif;

											?>
										</div>
									</div>								
								</div>

								<?php $link = get_field('box_link_1');?>
								<a class="d-block w-100 package1" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
									<div class="col-12 py-2 text-uppercase bg-congress main-text-congress mt-2 package1">
										<h5 class="d-inline align-middle package1">
											<strong class="package1"><?php echo $link['title']; ?></strong>
										</h5>
									</div>
								</a>
							</div>
						</div>
					</div>

					<div class="col-12 col-lg-4 py-4 py-lg-0">
						<div class="container-fluid border border-cbcbcb">
							<div class="row">

								<div class="col-12 pt-2 text-uppercase bg-congress main-text-congress">
									<h4 class="d-inline align-middle"> <?php the_field('register_box_title_2'); ?> </h4>
									<h6 class="small"> <?php if(get_field('main_subtitle_2')) the_field('main_subtitle_2'); else echo '&emsp14;'; ?> </h6>
								</div>
								<div class="col-12 border-bottom border-secondary mb-2 py-2">
									<h1><?php the_field('top_price_2'); ?></h1>
								</div>

								<div class="col-12 py-1 col-sm-6 border-right border-secondary min-lg-h100">
									<h6 class="mb-0 text-secondary text-uppercase"><?php if(get_field('left_price_top_2')) the_field('left_price_top_2'); else echo '&emsp14;'; ?></h6>
                                    <small class="text-secondary text-uppercase"><?php if(get_field('left_price_top_1')) the_field('left_price_valid_2'); else echo '&emsp14;'; ?></small>
									<h4><strong><?php the_field('left_price_2');?></strong></h4>
								</div>
								<div class="col-12 py-1 col-sm-6">
									<h6 class="mb-0 text-secondary text-uppercase"><?php if(get_field('right_price_top_2')) the_field('right_price_top_2'); else echo '&emsp14;'; ?></h6>
                                    <small class="text-secondary text-uppercase"><?php if(get_field('right_price_top_2')) the_field('right_price_valid_2'); else echo '&emsp14;'; ?></small>
									<h4><strong><?php the_field('right_price_2');?></strong></h4>
								</div>
								<div class="col-12 px-0">
									<div class="collapse multi-collapse" id="multiCollapseExample2">
										<div class="">
											<?php
											$cont = 0;
												if( have_rows('description_rows_2') ):
													while ( have_rows('description_rows_2') ) : the_row();
														if( get_row_layout() == 'row' ):
															if($cont%2 == 0){ echo '<p class="bg-EC px-2">'; }else{ echo '<p class="px-2">'; }
															the_sub_field('description');
															echo '</p>';
															$cont = $cont + 1;
														endif;
													endwhile;
												endif;

											?>
										</div>
									</div>								
								</div>

								<?php $link = get_field('box_link_2');?>
								<a class="d-block w-100 package2" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
									<div class="col-12 py-2 text-uppercase bg-congress main-text-congress mt-2 package2">
										<h5 class="d-inline align-middle package2">
											<strong class="package2"><?php echo $link['title']; ?></strong>
										</h5>
									</div>
								</a>
							</div>
						</div>
					</div>

					<div class="col-12 col-lg-4 py-4 py-lg-0">
						<div class="container-fluid border border-cbcbcb">
							<div class="row">

								<div class="col-12 pt-2 text-uppercase bg-congress main-text-congress">
									<h4 class="d-inline align-middle"> <?php the_field('register_box_title_3'); ?> </h4>
									<h6 class="small"> <?php if(get_field('main_subtitle_3')) the_field('main_subtitle_3'); else echo '&emsp14;'; ?> </h6>
								</div>
								<div class="col-12 border-bottom border-secondary mb-2 py-2">
									<h1><?php the_field('top_price_3'); ?></h1>
								</div>

								<div class="col-12 py-1 col-sm-6 border-right border-secondary min-lg-h100">
									<h6 class="mb-0 text-secondary text-uppercase"><?php if(get_field('left_price_top_3')) the_field('left_price_top_3'); else echo '&emsp14;'; ?></h6>
                                    <small class="text-secondary text-uppercase"><?php if(get_field('left_price_top_1')) the_field('left_price_valid_3'); else echo '&emsp14;'; ?></small>
									<h4><strong><?php the_field('left_price_3');?></strong></h4>
								</div>
								<div class="col-12 py-1 col-sm-6">
									<h6 class="mb-0 text-secondary text-uppercase"><?php if(get_field('right_price_top_3')) the_field('right_price_top_3'); else echo '&emsp14;'; ?></h6>
                                    <small class="text-secondary text-uppercase"><?php if(get_field('right_price_top_3')) the_field('right_price_valid_3'); else echo '&emsp14;'; ?></small>
									<h4><strong><?php the_field('right_price_3');?></strong></h4>
								</div>
								<div class="col-12 px-0">
									<div class="collapse multi-collapse" id="multiCollapseExample3">
										<div class="">
											<?php
											$cont = 0;
												if( have_rows('description_rows_3') ):
													while ( have_rows('description_rows_3') ) : the_row();
														if( get_row_layout() == 'row' ):
															if($cont%2 == 0){ echo '<p class="bg-EC px-2">'; }else{ echo '<p class="px-2">'; }
															the_sub_field('description');
															echo '</p>';
															$cont = $cont + 1;
														endif;
													endwhile;
												endif;

											?>
										</div>
									</div>								
								</div>

								<?php $link = get_field('box_link_3');?>
								<a class="d-block w-100 package3" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
									<div class="col-12 py-2 text-uppercase bg-congress main-text-congress mt-2 package3">
										<h5 class="d-inline align-middle package3">
											<strong class="package3"><?php echo $link['title']; ?></strong>
										</h5>
									</div>
								</a>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>


		<div id="register-three">
			<div class="container">
				<div class="row text-center">
					<div class="col-12 col-sm-12 pt-5">
						<?php 
						$link = get_field('section_3_button_link');
						if($link){ ?>
							<a class="btn btn-congress" target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>">
								<?php echo $link['title']; ?>
						</a>
						<?php } ?>
						
					</div>
				</div>
			</div>
		</div>

		<div id="six">
			<?php get_template_part( 'template/partners', 'index' ); ?>
		</div>

		<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>