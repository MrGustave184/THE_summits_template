<?php 
	if(get_field('enable_programme')) : 
	    $pageData = get_field('programme_group');
			if( $pageData ) :
?>
                <div id="four" class="programme">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-12 col-sm-12">
                                <?php if($pageData['programme_section_title']) : ?>
                                    <h3> <?php echo $pageData['programme_section_title']; ?> </h3>
                                    <hr>
                                <?php endif; ?>
                            </div>

                            <div class="col-12 col-sm-12 pb-4">
                                <?php echo $pageData['programme_section_sub-title']; ?>
                            </div>
                        </div>
                    </div>
                    <?php get_template_part( 'template/officialpg', 'widget' ); ?>
                </div>
                
                <hr class="meta-border">
<?php 
        endif;
    endif; 

    if ($pageData['programme_background'] == 0) {
        $background2 = $pageData['programme_background_color'];
    } else {
        $bgimg2 = $pageData['programme_background_image'];
        $background2 = 'URL(' . $bgimg2 . ')';
    } 

    $color = $pageData['programme_text_color'];
?>

<style type="text/css">
    .programme {
        background: <?php echo $background2; ?>;
        color: <?php echo $color; ?>;
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>