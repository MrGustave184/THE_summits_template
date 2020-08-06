<?php 
    if( get_field('enable_about') ) : 
        $pageData = get_field('about_group');

        if($pageData) :
            $title = $pageData['about_section_title'];
            $content = $pageData['about_section_content'];
?>
    <div id="three" class="about">
        <div class="container">
            <div class="row text-center">
                <?php if(have_content($content)) : ?>
                    <div class="title col-12 col-lg-6">
                        <div>
                            <h3> <?php echo $title; ?></h3>
                            <hr>
                        </div>
                        <div>
                            <?php echo $content ?>
                        </div>
                    </div>
                    <div class="title col-12 col-lg-6">
                        <img src="<?php echo $pageData['about_section_image']; ?>" alt="right-img">
                    </div>
                <?php else : ?>
                    <div class="col-12">
                        <img src="<?php echo $pageData['about_section_image']; ?>" alt="right-img">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <hr class="meta-border">
    
<?php 
    endif;
    endif; 

    if ($pageData['about_background'] == 0) {
        $background2 = $pageData['about_background_color'];
    } else {
        $bgimg2 = $pageData['about_background_image'];
        $background2 = 'URL(' . $bgimg2 . ')';
    } 

    $color = $pageData['about_text_color'];
?>

<style type="text/css">
    .about {
        background: <?php echo $background2; ?>;
        color: <?php echo $color; ?>;
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>