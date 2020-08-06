<?php 
    if( get_field('enable_registration') ) : 
        $pageData = get_field('registration_group');

        if($pageData) :
            $title = $pageData['registration_section_title'];
            $content = $pageData['registration_section_text'];
?>
	<div id="three" class="registration">
		<div class="container">
			<div class="row text-center">
				<?php if(have_content($content)) : ?>
					<div class="col-12">
						<h3> <?php echo $title; ?></h3>
						<hr>
					</div>
				<?php endif; ?>

				<div class="col-12">
						<?php echo $content; ?>
				</div>

				<div class="col-12">
					<?php
						echo $pageData['registration_section_form'];
						// echo do_shortcode("[iframe src=\"$form\" width='100%' height='480px']");
					?>
				</div>
			</div>
		</div>
	</div>
<?php endif;endif; ?>