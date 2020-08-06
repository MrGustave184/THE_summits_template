<?php
    include 'helpers/programmeFunctions.php';
    /**
     * Template name: Concurrent Event Programme
     */
    
    get_header(); 

    $settings_page_id = get_id_by_slug('settings');
    $main_congress_color = get_field('main_congress_color', $settings_page_id);
    $main_text_color = get_field('main_text_color', $settings_page_id);
    $tablespk = $wpdb->base_prefix."synclogic_speakers";


    while (have_posts()) :
        the_post(); 
        header_by_ID( get_the_ID());

        $sessionDays = getSessionDays();
?>

<style>
    .speaker {
        width: 70px;
        height: 70px;
        object-fit: cover;
    }

    table{
        width: auto !important;
    }

    .list-group-item.active {
        color: <?php echo $main_text_color; ?>;
        background-color: <?php echo $main_congress_color; ?>;
        border-color:  <?php echo $main_congress_color; ?>;
    }

    .speaker-info {
	    color: #000 !important;
    }

    .top-content-wrapper {
        display: flex;
        align-items: center;
    }

    .top-content {
        margin: 0 auto;
    }

    .info_speakerContent {
        width: 70% !important;
    }

    @media (min-width: 382px) {
        .info_speakerContent {
            padding-left: .25rem!important;
        }
    }
</style>

<!-- Programme -->
<div class="py-5">
    <div class="container-fluid">
        <div class="row">
            <?php if(postHaveContent()) : ?>
                <div class="col-12 top-content-wrapper">
                    <div class="top-content"><?= get_the_content(); ?></div>
                </div>
            <?php endif; ?>

            <!-- Days -->
            <div class="col-12 px-0">
                <div class="list-group flex-row text-center pb-5" id="list-tab" role="tablist">
                    <?php foreach($sessionDays as $key => $day) : ?>
                        <a class="list-group-item list-group-item-action <?= isSelectedDay($key) ? 'active' : ''; ?>"
                        id="list-<?= $key; ?>-list" data-toggle="list" href="#list-<?= $key; ?>"
                        role="tab" aria-controls="home"><?= formatDate($day->programme_day); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Content -->
            <div class="col-12">
                <div class="tab-content" id="nav-tabContent">

                    <?php
                        $contsessions = 1;
                        foreach($sessionDays as $key => $day){
                    ?>

                        <!-- Day Tab 1 -->
                        <div class="tab-pane fade <?= isSelectedDay($key) ? 'active show' : ''; ?>" id="list-<?= $key; ?>" role="tabpanel" aria-labelledby="list-<?= $key; ?>-list">
                            <div>
                                <div class="container-fluid">

                                    <?php
                                    $presentations = getPresentationsByDay($day->programme_day);
                                    $ind=0; $spkind = 0; $spkcont = 0;

                                    for ($i=0; $i < count($presentations); $i++) :
                                        if ($i == 0 || ($presentations[$i]->start_time != $presentations[$i-1]->start_time)) :
                                        ?>
                                        <div class="row pb-4">
                                            <!-- Time -->
                                            <div class="col-12 text-center col-md-2 border-bottom mt-1">
                                                <strong><?php echo $presentations[$i]->start_time; ?></strong>
                                            </div>
                                        <?php endif; ?>
                                            <!-- Session -->
                                            <div class="col-12 col-md pb-3 pb-md-4 border-right border-left border-bottom">

                                                <!-- Session Title -->
                                                <h4 class="session_title pt-3 pt-md-0">
                                                    <a href="#" data-toggle="modal" data-target="#sessionModal-<?php echo $contsessions; ?>">
                                                        <?php echo $presentations[$i]->session_title;?>
                                                    </a>
                                                </h4>

                                                <!-- Session Title Modal -->
                                                <div class="modal fade" id="sessionModal-<?php echo $contsessions; ?>" tabindex="-1" role="dialog"
                                                    aria-labelledby="sessionModal-<?php echo $contsessions; ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title w-100 color-congress" id="exampleModalCenterTitle">
                                                                    <?php echo $presentations[$i]->session_title;?>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>


                                                            <!-- Session time -->
                                                            <div class="presentation-time" style="padding:.5rem 0 0 1rem;">
                                                                <strong><?php echo $presentations[$i]->start_time . " - " . $presentations[$i]->end_time; ?></strong>
                                                            </div>

                                                            <!-- Location -->
                                                            <?php if($presentations[$i]->room_name) : ?>
                                                                <h6 class="location" style="padding:.2rem 0 0 1rem;">
                                                                    Location: <?php echo $presentations[$i]->room_name; ?>
                                                                </h6>
                                                            <?php endif; ?>

                                                            <?php if($presentations[$i]->session_html) : ?>
                                                                <div class="modal-body text-justify">
                                                                    <?php echo $presentations[$i]->session_html;?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <!-- <div class="modal-footer">
                                                                <button type="button" class="btn btn-congress" data-dismiss="modal">Close</button>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Session time -->
                                                <div class="presentation-time">
                                                    <strong><?php echo $presentations[$i]->start_time . " - " . $presentations[$i]->end_time; ?></strong>
                                                </div>

                                                <!-- Location -->
                                                <?php if($presentations[$i]->room_name) : ?>
                                                    <h6 class="location">
                                                        Location: <?php echo $presentations[$i]->room_name; ?>
                                                    </h6>
                                                <?php endif; ?>

                                                <?php $contsessions++; ?>

                                            <!-- Speakers -->

                                            <!-- ONLY FOR THE CHAIRMANS -->
                                    <?php
                                    // all_chairs order by Last Name
                                    if( strlen($presentations[$i]->all_chairs) > 0){
                                        $parts = explode(";",$presentations[$i]->all_chairs); // ALL DATA COMES WITH ; AS SEPARATOR
                                        $parts2 = str_replace(";",",",$presentations[$i]->all_chairs);
                                        $parts2 = rtrim($parts2,',');
                                        //echo $parts;
                                        

                                        $qwr = $wpdb->get_results("SELECT * FROM $tablespk WHERE speaker_id in ($parts2) ORDER BY speaker_family_name");
                                        echo '<div>Chair</div>';
                                 
                                        foreach($qwr as $tsp){
                                            // GET ALL DATA ABOUT THE SPEAKER
                                            //$tsp = $wpdb->get_results("SELECT * FROM $tablespk WHERE speaker_id = '$only'"); ?>

                                            <?php
                                            if($tsp->speaker_name){ ?>
                                                <div class="col-12 speaker_item">
                                                    <a data-toggle="modal" data-target="#<?php echo $cont;; ?>-<?php echo $spkcont; ?>">
                                                        <img src="<?php echo $tsp->image_profile; ?>" alt="" class="team-member-image align-middle ">

                                                        <div class="info_speakerContent pl-2">
                                                            <div class="col-12 color-congress speaker_name pl-0 pl-sm-1">
                                                                <?php echo $tsp->speaker_name." ".$tsp->speaker_family_name; ?></div>
                                                            <div class="col-12 speaker_info pl-0 pl-sm-1">
                                                                <?php if($tsp->job_title != "") echo $tsp->job_title; ?> <br> <?php echo $tsp->company; ?></div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="<?php echo $cont; ?>-<?php echo $spkcont; ?>"
                                                     tabindex="-1" role="dialog" aria-labelledby="speakerModalLabel<?php echo $spkcont; ?>" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close position-absolute btn-congress" data-dismiss="modal" aria-label="Close" style="right: 0;
                                                                            z-index: 1;
                                                                            border-radius: 25px;
                                                                            height: 45px;
                                                                            width: 45px;
                                                                            opacity: 1;
                                                                            top: 10px;
                                                                            ">
                                                                            <span style="height: 45px;
                                                                            width: 45px;
                                                                            display: block;
                                                                            left: 0;
                                                                            position: absolute;
                                                                            top: 10px;" aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div> <img src="<?php echo $tsp->image_profile; ?>" alt="Speaker-<?php echo $spkcont; ?>-<?php echo $spkind;?>"> </div>
                                                                <div class="color-congress">
                                                                    <strong>
                                                                        <h4><?php echo $tsp->speaker_name." ".$tsp->speaker_family_name; ?></h4>
                                                                    </strong>
                                                                </div>
                                                                <div> <?php echo $tsp->job_title; ?> </div>
                                                                <div> <?php echo $tsp->company; ?> </div>
                                                                <div class="mt-3"> <?php echo $tsp->biography; ?> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }// If Speaker Name or if exist.?>

                                            <?php
                                            $spkcont = $spkcont+1;
                                        }//FOR SPEAKERS
                                        $spkind = $spkind + 1;
                                    }//FOR SECTIONS
                                    ?>
                                    <!--ONLY FOR THE CHAIRMAN -->


                                    <?php
                                    // all_faculties order by Last Name
                                    if( strlen($presentations[$i]->all_faculties) > 0){
                                        $parts = explode(";",$presentations[$i]->all_faculties); // ALL DATA COMES WITH ; AS SEPARATOR
                                        $parts2 = str_replace(";",",",$presentations[$i]->all_faculties);
                                        $parts2 = rtrim($parts2,',');
                                        //echo $parts;
                                        

                                        $qwr = $wpdb->get_results("SELECT * FROM $tablespk WHERE speaker_id in ($parts2) ORDER BY speaker_family_name");
                                        ?>
                                        <div><?php echo count($qwr) > 1 ? 'Speakers' : 'Speaker';?></div>
                                 <?php
                                        foreach($qwr as $tsp){
                                            // GET ALL DATA ABOUT THE SPEAKER
                                            //$tsp = $wpdb->get_results("SELECT * FROM $tablespk WHERE speaker_id = '$only'"); ?>

                                            <?php
                                            if($tsp->speaker_name){ ?>
                                                <div class="col-12 speaker_item">
                                                    <a data-toggle="modal" data-target="#<?php echo $cont;; ?>-<?php echo $spkcont; ?>">
                                                        <img src="<?php echo $tsp->image_profile; ?>" alt="" class="team-member-image align-middle ">

                                                        <div class="info_speakerContent pl-2">
                                                            <div class="col-12 color-congress speaker_name pl-0 pl-sm-1">
                                                                <?php echo $tsp->speaker_name." ".$tsp->speaker_family_name; ?></div>
                                                            <div class="col-12 speaker_info pl-0 pl-sm-1"><?php echo $tsp->job_title; ?> <br> <?php echo $tsp->company; ?></div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="<?php echo $cont; ?>-<?php echo $spkcont; ?>"
                                                     tabindex="-1" role="dialog" aria-labelledby="speakerModalLabel<?php echo $spkcont; ?>" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close position-absolute btn-congress" data-dismiss="modal" aria-label="Close" style="right: 0;
                                                                            z-index: 1;
                                                                            border-radius: 25px;
                                                                            height: 45px;
                                                                            width: 45px;
                                                                            opacity: 1;
                                                                            top: 10px;
                                                                            ">
                                                                            <span style="height: 45px;
                                                                            width: 45px;
                                                                            display: block;
                                                                            left: 0;
                                                                            position: absolute;
                                                                            top: 10px;" aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div> <img src="<?php echo $tsp->image_profile; ?>" alt="Speaker-<?php echo $spkcont; ?>-<?php echo $spkind;?>"> </div>
                                                                <div class="color-congress">
                                                                    <strong>
                                                                        <h4><?php echo $tsp->speaker_name." ".$tsp->speaker_family_name; ?></h4>
                                                                    </strong>
                                                                </div>
                                                                <div> <?php echo $tsp->job_title; ?> </div>
                                                                <div> <?php echo $tsp->company; ?> </div>
                                                                <div class="mt-3"> <?php echo $tsp->biography; ?> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }// If Speaker Name or if exist.?>

                                            <?php
                                            $spkcont = $spkcont+1;
                                        }//FOR SPEAKERS
                                        $spkind = $spkind + 1;
                                    }//FOR SECTIONS
                                    ?>


                                            </div>

                                                <?php
                                                if ($presentations[$i+1]->start_time != $presentations[$i]->start_time) {
                                                    echo "</div>";
                                                }
                                    endfor; // END LOOP PRESENTATIONS
                                                ?>


                                   

                                </div>
                            </div>
                        </div>
                    <?php $cont++; } // END LOOP DAYS ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="summit-six">
    <div class="container">
        <?php get_template_part( 'template/partners', 'index' ); ?>
    </div>
</div>


    <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>