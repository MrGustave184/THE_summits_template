<?php
    include 'helpers/Programme.php';
    include 'helpers/Presentation.php';

    $programme = new Programme($wpdb);
    $days = $programme->get_days();
    $modalId = 0;
    $settings_page_id = get_id_by_slug('settings');
    $main_congress_color = get_field('main_congress_color', $settings_page_id);
    $main_text_color = get_field('main_text_color', $settings_page_id);
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<style>
    .time-span {
        background-color: <?php echo $main_congress_color; ?>;
        color: <?php echo $main_text_color; ?>;
    }

    .session {
        border: 1px solid <?php echo $main_congress_color; ?>;
    }
</style>

<!-- Desktop layout -->
<div class="ext-container">
    <div id="programme" class="tabbable programmeTab">
        <?php $programme->render_days_panel(); ?>
    </div>

    <!-- Render grids by day -->
    <?php 
        foreach($days as $key => $day) : 
                $presentations = $programme->presentations_by_day($day->programme_day);
                $grid = $programme->create_grid($presentations);
    ?>
        <div class="tab-grid <?php if($key == 0) echo 'active'; ?>" id="<?php echo $day->programme_day; ?>">
            <div class="schedule container-fluid tab-pane" id="<?php echo $day->programme_day; ?>" style="grid-template-rows:<?php echo $grid['rows']; ?>;grid-template-columns:<?php echo $grid['columns']; ?>">
                <?php 
                    $programme->render_hours($presentations); 
                    $rooms = [];
                    $columns = 1;

                    foreach($presentations as $pres_key => $presentation_obj) :
                        $presentation = new Presentation($presentation_obj, $wpdb);  
                        // print_r($presentation);die;
                        $rooms = $presentation->find_room($rooms);
                ?>
                        <!-- Session Card -->
                        <div class="session" id="<?php echo 'session-'.$presentation->get_session_id(); ?>" style="grid-column: track-<?php echo $presentation->track; ?>; grid-row:<?php $presentation->time_row(); ?>;" data-toggle="modal" data-target="<?php echo '#'.$presentation->get_session_id(); ?>">
                            <!-- Session title -->
                            <h4 class="session-title"><div class="color-congress"><?php $presentation->session_title(); ?></div></h4>

                            <!-- Session time -->
                            <?php if($presentation->time_exists()) : ?>
                                <span class="session-time"><?php $presentation->the_time(); ?></span>
                            <?php endif; ?>

                            <!-- Session location -->
                            <?php if($presentation->location_exists()) : ?>
                                <span class="session-room">Location: <?php $presentation->location(); ?></span>
                            <?php endif; ?>
                            
                            <!-- Session chairs -->
                            <?php if($presentation->chairs_exists()) : ?>
                                <span class="session-chairs"><?php echo $presentation->list_chairs(); ?></span>
                            <?php endif; ?>
                            
                            <!-- Session speakers -->
                            <?php if($presentation->faculties_exists()) : ?>
                                <span class="session-speakers"><?php echo $presentation->list_faculties(); ?></span>
                            <?php endif; ?>
                          
                            <!-- <img src="https://i.stack.imgur.com/vzZvv.png" alt=""> -->
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="<?php echo $presentation->get_session_id(); ?>" tabindex="-1" role="dialog" aria-labelledby="session-modal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title color-congress" id="exampleModalLabel">
                                            <?php $presentation->session_title(); ?>
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Session time -->
                                        <?php if($presentation->time_exists()) : ?>
                                            <span class="session-modal session-time"><?php $presentation->the_time(); ?></span>
                                        <?php endif; ?>

                                        <!-- Session location -->
                                        <?php if($presentation->location_exists()) : ?>
                                            <span class="session-modal session-room">Location: <?php $presentation->location(); ?></span>
                                        <?php endif; ?>
                                        
                                        <!-- Session HTML -->
                                        <?php if($presentation->session_html_exists()) : ?>
                                            <div class="session-modal session-html">
                                                <p><?php echo $presentation->session_html(); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <?php if($presentation->faculties_exists() || $presentation->chairs_exists()) : ?>
                                            <div class="session-modal session-speakers w-100">

                                                <!-- Chairs -->
                                                <?php if($presentation->chairs_exists()) : ?>
                                                    <span><?php echo $presentation->count_chairs() ? 'Chairs' : 'Chair'; ?></span>
                                                    <?php foreach($presentation->get_chairs() as $key => $chair) : ?>
                                                        <div class="speaker_item row">
                                                            <img src="<?php echo $chair->image_profile; ?>" alt="" class="team-member-image align-left">
                                                            <div class="info_speakerContent">
                                                                <div class="col-12 color-congress speaker_name">
                                                                    <a data-toggle="collapse" data-target="<?php echo '#chair-'.$modalId.'-'.$chair->speaker_name."-".$chair->speaker_family_name; ?>">
                                                                        <?php echo $chair->speaker_name." ".$chair->speaker_family_name; ?>
                                                                    </a>
                                                                </div>
                                                                <div class="col-12 speaker_info">
                                                                    <?php echo $chair->job_title; ?> 
                                                                </div>
                                                                <div class="col-12 speaker_info">
                                                                    <?php echo $chair->company; ?> 
                                                                </div>
                                                            </div>
                                                            <div class="collapse" id="<?php echo 'chair-'.$modalId.'-'.$chair->speaker_name."-".$chair->speaker_family_name; ?>">
                                                                <div class="modal-speaker-bio">
                                                                    <?php echo $chair->biography; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                
                                                <!-- Speakers -->
                                                <span><?php echo $presentation->count_faculties() ? 'Speakers' : 'Speaker'; ?></span>
                                                <?php foreach($presentation->get_faculties() as $key => $speaker) : ?>
                                                    <div class="speaker_item row">
                                                        <img src="<?php echo $speaker->image_profile; ?>" alt="" class="team-member-image align-left">
                                                        <div class="info_speakerContent">
                                                            <div class="col-12 color-congress speaker_name">
                                                                <a data-toggle="collapse" data-target="<?php echo '#speaker-'.$modalId.'-'.$speaker->speaker_name."-".$speaker->speaker_family_name; ?>">
                                                                    <?php echo $speaker->speaker_name." ".$speaker->speaker_family_name; ?>
                                                                </a>
                                                            </div>
                                                            <div class="col-12 speaker_info">
                                                                <?php echo $speaker->job_title; ?> 
                                                            </div>
                                                            <div class="col-12 speaker_info">
                                                                <?php echo $speaker->company; ?> 
                                                            </div>
                                                        </div>

                                                        <div class="collapse" id="<?php echo 'speaker-'.$modalId.'-'.$speaker->speaker_name."-".$speaker->speaker_family_name; ?>">
                                                            <div class="modal-speaker-bio">
                                                                <?php echo $speaker->biography; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php 
                    $modalId++;
                    endforeach; 
                ?>
            </div>
        </div>
    <?php 
        endforeach; 
    ?>
</div>


<!-- Responsive layout -->
<div class="responsive row" style="margin: 0">
    <!-- This first section of the code is only for create the TOP Tabs with the name of the Months. -->
    <!-- At this point, it only writes the March dates at the top - clickeable -->
    <div id="programme" class="tabbable programmeTab"> <!-- Only required for left/right tabs -->
        <!-- CREATE TABS -->
        <div class="bg-congress main-text-congress">
            <ul class="nav nav-tabs trans05 align-items-center" style="width: 95%;margin: 0 auto;">
                <?php $cont=0; ?>
                <?php
                // GET ALL DATA ABOUT THE PROGRAMME GROUPING BY DAYS
                $table = $wpdb->base_prefix."synclogic_programme";
                $tablespk = $wpdb->base_prefix."synclogic_speakers";
                $days = $wpdb->get_results("SELECT DISTINCT programme_day_name, programme_day FROM $table ORDER BY programme_day ASC");

                foreach($days as $day){ ?>
                    <li class="trans05 col-6 px-0 col-sm">
                        <a href="#tab<?= $cont; ?>" data-toggle="tab" class="text-sm-center trans05 <?php if ($cont==0) { echo 'active show';} ?>">
                            <span style="font-size: 18px; font-weight:500">
                                <?= date("l d F Y", strtotime($day->programme_day)); ?>
                            </span>
                        </a>
                    </li>

                    <?php
                    $cont = $cont+1;
                } ?>
            </ul>
        </div>
        <!-- CLOSE TABS -->

        <!-- CONTENT -->
        <div class="col-12 col-md-10 offset-md-1  tab-content" style="padding-top: 0px;">
        <!-- New Programme -->

        <!-- Old Programme -->
            <?php $cont=0; $contt=0;

            // GET ALL DATA ABOUT THE PROGRAMME GROUPING BY DAYS
            $table = $wpdb->base_prefix."synclogic_programme";
            $tablespk = $wpdb->base_prefix."synclogic_speakers";
            $days = $wpdb->get_results("SELECT DISTINCT programme_day_name,programme_day FROM $table ORDER BY programme_day ASC");

            $ind=0; 
            foreach($days as $day){  ?>

                <div class="col-12 trans05 tab-pane noPadding fade <?php if ($contt==0) { echo 'in active show';} ?>"
                     id="tab<?= $contt; ?>">
                    <?php
                    // GET ALL DATA ABOUT THE SESSION OF A SPECIFIC DAY
                    $currentDay = $day->programme_day;
                    $presentations = $wpdb->get_results("SELECT * FROM $table WHERE programme_day = '$currentDay' ORDER BY start_time ASC");

                    // print_r($presentations[0]);die;
                    // <div class="dropdown-arrow"></div>
                    $spkind = 0; $spkcont = 0;
                    foreach($presentations as $present) {
                        // $have_dropdown = $present->session_html ? 'dropdown-arrow' : '';
                        ?>
                        <div class="accordion" id="accordion-<?= $ind ?>">
                            <div class="card">
                                <div class="card-header" id="heading-<?= $ind ?>">
                                <h2 class="mb-0">
                                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" data-target="#collapse-<?= $ind ?>" aria-expanded="true" aria-controls="collapse-<?= $ind ?>">
                                        <div class="row">
                                            <div class="col-11">
                                                <div class="description_content">
                                                    <h3 class="<?php //echo $have_dropdown; ?>"><?= $present->session_title;?></h3>
                                                </div>
                                            </div>
                                            <?php if($present->session_html || strlen($present->all_chairs) > 0 || strlen($present->all_faculties) > 0) : ?>
                                                <div class="col-1 mobile-dropdown-arrow"><i class="fas fa-chevron-down fa-2x"></i></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="description_content">
                                                    <?php 
                                                    if($present->room_name) { ?>
                                                        <h6>Location: <?= $present->room_name ?></h6>
                                                    <?php }?>
                                                </div>
                                            </div>
                                            <div class="col-12 time">
                                                <?php 
                                                if( strcmp ( " 00:00" , $present->start_time ) != 0) { 
                                                    echo $present->start_time; }
                                                if( strcmp ( " 00:00" , $present->end_time ) != 0) {
                                                    echo " - " . $present->end_time; } ?>
                                            </div>
                                        </div>
                                    </a>
                                </h2>
                                </div>

                                <?php
                                if($present->session_html || strlen($present->all_chairs) > 0){ ?>

                                    <div id="collapse-<?= $ind ?>" class="collapse" aria-labelledby="heading-<?= $ind ?>" data-parent="#accordion-<?= $ind ?>">
                                        <div class="card-body">
                                            <div class="description_content pb-2">
                                                <?php
                                                    if($present->session_html) { echo  $present->session_html ; }
                                                ?>
                                            </div>
                                            <!-- IF WE HAVE SPEAKERS -->

                                            <!-- ONLY FOR THE CHAIRMANS -->
                                            <?php
                                            // all_chairs order by Last Name
                                            if( strlen($present->all_chairs) > 0){
                                                $parts = explode(";",$present->all_chairs); // ALL DATA COMES WITH ; AS SEPARATOR
                                                $parts2 = str_replace(";",",",$present->all_chairs);
                                                $parts2 = rtrim($parts2,',');
                                                

                                                $qwr = $wpdb->get_results("SELECT * FROM $tablespk WHERE speaker_id in ($parts2) ORDER BY speaker_family_name");
                                                echo '<div>Chair</div>';
                                        
                                                foreach($qwr as $tsp){
                                                    // GET ALL DATA ABOUT THE SPEAKER ?>

                                                    <?php
                                                    if($tsp->speaker_name){ ?>
                                                        <div class="col-12 speaker_item">
                                                            <a data-toggle="modal" data-target="#<?= $cont; ?>-<?= $spkcont; ?>">
                                                                <img src="<?= $tsp->image_profile; ?>" alt="" class="team-member-image align-middle">

                                                                <div class="info_speakerContent pl-0 pl-sm-1">
                                                                    <div class="col-12 color-congress speaker_name pl-0 pl-sm-1">
                                                                        <?= $tsp->speaker_name." ".$tsp->speaker_family_name; ?></div>
                                                                    <div class="col-12 speaker_info pl-0 pl-sm-1">
                                                                        <?php if($tsp->job_title != "") echo $tsp->job_title." - "; ?>  <?= $tsp->company; ?></div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="<?= $cont; ?>-<?= $spkcont; ?>"
                                                            tabindex="-1" role="dialog" aria-labelledby="speakerModalLabel<?= $spkcont; ?>" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <button type="button" class="close btn-congress" data-dismiss="modal">×</button>
                                                                    <div class="modal-body">
                                                                        <div> <img class="w-100" src="<?= $tsp->image_profile; ?>" alt="Speaker-<?= $spkcont; ?>-<?= $spkind;?>"> </div>
                                                                        <div class="color-congress pt-3">
                                                                            <strong>
                                                                                <h4><?= $tsp->speaker_name." ".$tsp->speaker_family_name; ?></h4>
                                                                            </strong>
                                                                        </div>
                                                                        <div> <?= $tsp->job_title; ?> </div>
                                                                        <div> <?= $tsp->company; ?> </div>
                                                                        <div class="mt-3"> <?= $tsp->biography; ?> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $spkcont = $spkcont+1;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <!--ONLY FOR THE CHAIRMAN -->


                                                <?php
                                                // all_faculties order by Last Name
                                                if( strlen($present->all_faculties) > 0){
                                                    $parts = explode(";",$present->all_faculties); // ALL DATA COMES WITH ; AS SEPARATOR
                                                    $parts2 = str_replace(";",",",$present->all_faculties);
                                                    $parts2 = rtrim($parts2,',');
                                                    //echo $parts;
                                                    

                                                    $qwr = $wpdb->get_results("SELECT * FROM $tablespk WHERE speaker_id in ($parts2) ORDER BY speaker_family_name");
                                                    $slug = count($qwr) > 1 ? 'Speakers' : 'Speaker';
                                                    echo '<div>'.$slug.'</div>';
                                            
                                                    foreach($qwr as $tsp){
                                                        // GET ALL DATA ABOUT THE SPEAKER
                                                        //$tsp = $wpdb->get_results("SELECT * FROM $tablespk WHERE speaker_id = '$only'"); ?>

                                                        <?php
                                                        if($tsp->speaker_name){ ?>
                                                            <div class="col-12 speaker_item">
                                                                <a data-toggle="modal" data-target="#<?= $cont; ?>-<?= $spkcont; ?>">
                                                                    <img src="<?= $tsp->image_profile; ?>" alt="" class="team-member-image align-middle ">

                                                                    <div class="info_speakerContent pl-0 pl-sm-1">
                                                                        <div class="col-12 color-congress speaker_name pl-0 pl-sm-1">
                                                                            <?= $tsp->speaker_name." ".$tsp->speaker_family_name; ?></div>
                                                                        <div class="col-12 speaker_info pl-0 pl-sm-1"><?= $tsp->job_title; ?> - <?= $tsp->company; ?></div>
                                                                    </div>
                                                                </a>
                                                            </div>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="<?= $cont; ?>-<?= $spkcont; ?>"
                                                                tabindex="-1" role="dialog" aria-labelledby="speakerModalLabel<?= $spkcont; ?>" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <button type="button" class="close btn-congress" data-dismiss="modal">×</button>
                                                                        <div class="modal-body">
                                                                            <div> <img class="w-100" src="<?= $tsp->image_profile; ?>" alt="Speaker-<?= $spkcont; ?>-<?= $spkind;?>"> </div>
                                                                            <div class="color-congress pt-3">
                                                                                <strong>
                                                                                    <h4><?= $tsp->speaker_name." ".$tsp->speaker_family_name; ?></h4>
                                                                                </strong>
                                                                            </div>
                                                                            <div> <?= $tsp->job_title; ?> </div>
                                                                            <div> <?= $tsp->company; ?> </div>
                                                                            <div class="mt-3"> <?= $tsp->biography; ?> </div>
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
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        $ind = $ind+1;
                    }
                    ?>
                </div>
                <?php
                $cont = $cont+1;
                $contt = $contt+1;
            }
            ?>
        </div>
        <!-- CLOSE CONTENT -->


        <script>
            $('.nav-tabs a').click(function(){
                $(this).tab('show');
            })
        </script>
    </div>
</div>

