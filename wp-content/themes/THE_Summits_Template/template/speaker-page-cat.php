<?php
/*
  * Template Name: Speakers Page CAT
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

    <div id="speakers-two">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-sm-12">
                    <?php if(get_field('speakers_section_title')) { ?>
                        <h3> <?php the_field('speakers_section_title'); ?> </h3>
                        <hr>
                    <?php } ?>
                </div>

                <div class="col-12 col-sm-12">
                    <?php the_field('speakers_section_sub-title'); ?>
                </div>
            </div>

            <!-- Synclogic Speakers -->
            <!-- SYNCLOGIC SPEAKERS LOOP TEMPLATE -->
            <div class="container">
                <div class="row text-center justify-content-start">
                    <?php
                    $CAT = get_field('category_number');
                    $table = $wpdb->base_prefix."synclogic_speakers";
                    $speakers = $wpdb->get_results("SELECT * FROM $table WHERE category_id = $CAT ORDER BY speaker_family_name");

                    foreach($speakers as $speaker){
                        ?>

                        <div class="col-12 col- col-sm-4 col-md-s5 mb-5 speaker">
                            <!-- Button trigger modal -->
                            <a class="" data-toggle="modal" data-target="#speakerModal<?php echo $speaker->speaker_id; ?>">
                                <div class="speaker-img-container">
                                    
                                <?php
                                if($speaker->image_profile){
                                    $image = $speaker->image_profile;
                                } else {
                                    $image = get_template_directory_uri()."/img/neutral.png";
                                } ?>
                                    
                                    <img src="<?php echo $image; ?>" alt="Speaker-<?php echo $speaker->speaker_id; ?>">
                                    <div class="overlay">
                                        <div class="text">View</div>
                                    </div>
                                </div>
                                <h6  class="mb-0"> <strong> <?php echo $speaker->speaker_name." ".$speaker->speaker_family_name; ?> </strong> </h6>
                                <div class="speaker-text"> <?php echo $speaker->job_title; ?> </div>
                                <div class="speaker-text"> <?php echo $speaker->company; ?> </div>
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="speakerModal<?php echo $speaker->speaker_id; ?>" tabindex="-1" role="dialog" aria-labelledby="speakerModalLabel<?php echo $speaker->speaker_id; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <button type="button" class="close btn-congress" data-dismiss="modal">&times;</button>
                                        <div class="modal-body">
                                            <div> <img src="<?php echo $image; ?>" alt="Speaker-<?php echo $speaker->speaker_id; ?>"> </div>
                                            <div class="color-congress"> <strong> <h4><?php echo $speaker->speaker_name." ".$speaker->speaker_family_name; ?></h4> </strong> </div>
                                            <div> <?php echo $speaker->job_title; ?> </div>
                                            <div> <?php echo $speaker->company; ?> </div>
                                            <div class="mt-3"> <?php echo $speaker->biography; ?> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }//foreach?>

                </div>
            </div>
            <!-- Synclogic Speakers Close -->

        </div>
    </div>

    <div id="speakers-four">
            <?php get_template_part( 'template/partners', 'index' ); ?>
    </div>

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>