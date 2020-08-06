<div class="row" style="margin: 0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


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
                        <a href="#tab<?php echo $cont; ?>" data-toggle="tab" class="text-sm-center trans05 <?php if ($cont==0) { echo 'active show';} ?>">
                            <span style="font-size: 18px; font-weight:500">
                                <?php echo date("l d F Y", strtotime($day->programme_day)); ?>
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
            <?php $cont=0; $contt=0;

            // GET ALL DATA ABOUT THE PROGRAMME GROUPING BY DAYS
            $table = $wpdb->base_prefix."synclogic_programme";
            $tablespk = $wpdb->base_prefix."synclogic_speakers";
            $days = $wpdb->get_results("SELECT DISTINCT programme_day_name,programme_day FROM $table ORDER BY programme_day ASC");

            foreach($days as $day){  ?>

                <div class="col-12 trans05 tab-pane noPadding fade <?php if ($cont==0) { echo 'in active show';} ?>"
                     id="tab<?php echo $cont; ?>">
                    <?php
                    // GET ALL DATA ABOUT THE SESSION OF A SPECIFIC DAY
                    $currentDay = $day->programme_day;
                    $presentations = $wpdb->get_results("SELECT * FROM $table WHERE programme_day = '$currentDay' ORDER BY start_time ASC");

                    // print_r($presentations[0]);die;
                    
                    $ind=0; $spkind = 0; $spkcont = 0;
                    foreach($presentations as $present) {
                        ?>
                        <div class="container noPadding">
                            <div class="row item border-congress" style="position: relative; margin: 0">
                                <div class="col-md-3 col-12 noPadding">
                                    <span class="col-12 time">

                                        <?php if( strcmp ( " 00:00" , $present->start_time ) != 0)
                                            {  echo $present->start_time; }
                                            if( strcmp ( " 00:00" , $present->end_time ) != 0) { echo " - " . $present->end_time; } ?> </span>
                                  <?php //if( strcmp ( "00:00" , $present->start_time ) == 0) { echo "<div>same time</div>"; } ?>
                                </div>
                                <div class="col-md-9 col-12">
                                    <div class="description_content">
                                        <h3><?php echo $present->session_title;?></h3>
                                        <?php 
                                        if($present->room_name) { ?>
                                            <h6>Location: <?php echo $present->room_name ?></h6>
                                        <?php }?>
                                        
                                    </div>
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

                                                        <div class="info_speakerContent pl-0 pl-sm-1">
                                                            <div class="col-12 color-congress speaker_name pl-0 pl-sm-1">
                                                                <?php echo $tsp->speaker_name." ".$tsp->speaker_family_name; ?></div>
                                                            <div class="col-12 speaker_info pl-0 pl-sm-1">
                                                                <?php if($tsp->job_title != "") echo $tsp->job_title." - "; ?>  <?php echo $tsp->company; ?></div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="<?php echo $cont; ?>-<?php echo $spkcont; ?>"
                                                     tabindex="-1" role="dialog" aria-labelledby="speakerModalLabel<?php echo $spkcont; ?>" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <button type="button" class="close btn-congress" data-dismiss="modal">×</button>
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
                                    if( strlen($present->all_faculties) > 0){
                                        $parts = explode(";",$present->all_faculties); // ALL DATA COMES WITH ; AS SEPARATOR
                                        $parts2 = str_replace(";",",",$present->all_faculties);
                                        $parts2 = rtrim($parts2,',');
                                        //echo $parts;
                                        

                                        $qwr = $wpdb->get_results("SELECT * FROM $tablespk WHERE speaker_id in ($parts2) ORDER BY speaker_family_name");
                                        echo '<div>Speakers</div>';
                                 
                                        foreach($qwr as $tsp){
                                            // GET ALL DATA ABOUT THE SPEAKER
                                            //$tsp = $wpdb->get_results("SELECT * FROM $tablespk WHERE speaker_id = '$only'"); ?>

                                            <?php
                                            if($tsp->speaker_name){ ?>
                                                <div class="col-12 speaker_item">
                                                    <a data-toggle="modal" data-target="#<?php echo $cont;; ?>-<?php echo $spkcont; ?>">
                                                        <img src="<?php echo $tsp->image_profile; ?>" alt="" class="team-member-image align-middle ">

                                                        <div class="info_speakerContent pl-0 pl-sm-1">
                                                            <div class="col-12 color-congress speaker_name pl-0 pl-sm-1">
                                                                <?php echo $tsp->speaker_name." ".$tsp->speaker_family_name; ?></div>
                                                            <div class="col-12 speaker_info pl-0 pl-sm-1"><?php echo $tsp->job_title; ?> - <?php echo $tsp->company; ?></div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="<?php echo $cont; ?>-<?php echo $spkcont; ?>"
                                                     tabindex="-1" role="dialog" aria-labelledby="speakerModalLabel<?php echo $spkcont; ?>" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <button type="button" class="close btn-congress" data-dismiss="modal">×</button>
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
                            </div>
                        </div>
                        <?php $contt = $contt+1; $ind = $ind +1;
                    }
                    ?>
                </div>
                <?php
                $cont = $cont+1;
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