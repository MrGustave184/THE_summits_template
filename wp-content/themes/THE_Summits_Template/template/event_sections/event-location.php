<?php 
    if( get_field('enable_location') ) : 
        $pageData = get_field('location_group');

        if($pageData) :
            $title = $pageData['location_section_title'];
            $content = $pageData['location_section_text'];
?>
    <?php?>
    <div id="three" class="location">
        <div class="container">

            <div class="row text-center align-items-center">

                <?php if(have_content($title)) : ?>
                    <div class="col-12">
                        <h3> <?php echo $title; ?></h3>
                        <hr>
                    </div>
                <?php endif; ?>

                <?php if(have_content($content)) { ?>
                    <div class="title col-12 col-md-6">
                        <?php
							if($pageData['location_media'] == 0) { ?>
								<img class="img-fluid" src="<?php echo $pageData['location_section_image']; ?>" alt="img">
						<?php	
							}else { 
								echo $pageData['location_section_iframe'];
								  }
						?>
                    </div>
                    <div class="col-12 col-sm-6">
                        <?php echo $content; ?>
                    </div>
                <?php } else { ?>
                    <div class="col-12">
						<?php
							if($pageData['location_media'] == 0) { ?>
								<img class=".img-fluid" src="<?php echo $pageData['location_section_image']; ?>" alt="img">
						<?php	
							}else { 
								echo $pageData['location_section_iframe'];
								  }
						?>
                    </div>
                <?php } ?>

            </div>

        </div>

    </div>
		<hr class="meta-border">

<?php 
    endif;
    endif; 

    if ($pageData['location_background'] == 0) {
        $background2 = $pageData['location_background_color'];
    } else {
        $bgimg2 = $pageData['location_background_image'];
        $background2 = 'URL(' . $bgimg2 . ')';
    } 

    $color = $pageData['location_text_color'];
?>

<style type="text/css">
    .location {
        background: <?php echo $background2; ?>;
        color: <?php echo $color; ?>;
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>