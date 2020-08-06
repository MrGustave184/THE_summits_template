<?php
    if(get_field('enable_speakers')) :
    $pageData = get_field('speakers_group');

    if( $pageData ) :
?>
        <div id="four" class="speakers">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12 col-sm-12">
                        <?php if($pageData['speakers_section_title']) : ?>
                            <h3> <?php echo $pageData['speakers_section_title']; ?> </h3>
                            <hr>
                        <?php endif; ?>
                    </div>

                    <div class="col-12 col-sm-12 pb-4">
                        <?php echo $pageData['speakers_section_sub-title']; ?>
                    </div>

                    <?php
                    //sending the amount of Speakers for the Front Page Section
                    set_query_var( 'speakers_section_amount', $pageData['speakers_section_amount'] );
                    ?>

                    <?php get_template_part('template/speakers', 'index'); ?>

                    <?php
                        $link = $pageData['speakers_section_button'];

                        if( $link ): 
                    ?>
                        <div class="col-12 col-sm-12">
                            <a class="btn btn-congress" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
                                <?php echo $link['title']; ?>
                            </a>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
        <hr class="meta-border">


<?php 
    endif;
endif; 

    if ($pageData['speakers_background'] == 0) {
        $background2 = $pageData['speakers_background_color'];
    } else {
        $bgimg2 = $pageData['speakers_background_image'];
        $background2 = 'URL(' . $bgimg2 . ')';
    } 

    $color = $pageData['speakers_text_color'];
?>




<style type="text/css">
    .speakers {
        background: <?php echo $background2; ?>;
        color: <?php echo $color; ?>;
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>