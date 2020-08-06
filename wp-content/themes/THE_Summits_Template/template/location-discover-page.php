<?php
/*
  * Template Name: Location - Discover
  * */
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

    <div id="summit-three">
    <div class="container">
        <div class="row p-0">
            <?php for($x = 1; $x < 3; $x++){ ?>
                <div class="col-12 col-sm-12 col-lg-6 p-0">
                    <?php if($x != 2){ ?>
                    <?php if(get_field('section_three_'.$x.'_title')){ ?>
                            <h3 class="text-center"> <?php the_field('section_three_'.$x.'_title');?> </h3>
                            <hr>
                        <?php }?>
                        <div class="pr-lg-5"> <?php the_field('section_three_'.$x.'_text');?>  </div>
                    <?php } else {?>
                        <?php if( get_field('section_three_'.$x.'_image') ) { ?><img src="<?php the_field('section_three_'.$x.'_image');?>"> <?php } ?>
                    <?php }?>
                </div>
                <div class="col-12 col-sm-12 col-lg-6 p-0">
                    <?php if($x != 2){ ?>
                        <?php if( get_field('section_three_'.$x.'_image') ) { ?><img src="<?php the_field('section_three_'.$x.'_image');?>"> <?php } ?>
                    <?php } else {?>
                        <?php if(get_field('section_three_'.$x.'_title')) {?>
                            <h3 class="text-center"> <?php the_field('section_three_'.$x.'_title');?> </h3>
                            <hr>
                        <?php }?>
                        <div class="pl-lg-5"> <?php the_field('section_three_'.$x.'_text');?>  </div>
                    <?php }?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

    <div id="summit-six">
                <?php get_template_part( 'template/partners', 'index' ); ?>
        </div>

    <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>