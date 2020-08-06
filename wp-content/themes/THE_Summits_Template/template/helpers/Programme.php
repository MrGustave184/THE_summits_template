<?php

// We use a custom intdiv function that does the same as the native php 7 intdiv function
// because we are using php 5 in the wordpress templates and we need to migrate

class Programme 
{
    private $wpdb;
    private $programme_table;
    private $speakers_table;
    private $days;
    private $times;

    public function __construct($wpdb) 
    {
        $this->wpdb = $wpdb;
        $this->programme_table = $wpdb->base_prefix."synclogic_programme";
        $this->speakers_table = $wpdb->base_prefix."synclogic_speakers";
        $this->days = $this->get_days();
        $this->times = $this->get_times();
    }

    public function get_days()
    {
        return $this->wpdb->get_results(
            "SELECT DISTINCT programme_day_name, programme_day FROM $this->programme_table ORDER BY programme_day ASC"
        );
    }

    public function presentations_by_day($currentDay)
    {
        return $this->wpdb->get_results(
            "SELECT * FROM $this->programme_table WHERE programme_day = '$currentDay' ORDER BY start_time ASC"
        );
    }

    public function get_categories()
    {
        return ['Category 1', 'Category 2', 'Category 3', 'Category 4', 'Category 5'];
    }

    public function render_days_panel()
    { 
        ?><div class="bg-congress main-text-congress">
            <div class="bg-congress main-text-congress">
                <ul class="nav nav-tabs trans05 align-items-center" style="width: 95%;margin: 0 auto;">
                    <?php 
                        foreach($this->days as $key => $day) : 
                            $id = $day->programme_day;
                            $href = "#".$id;
                    ?>
                        <li class="trans05 col-6 px-0 col-sm">
                            <a href="<?php echo $href; ?>" data-toggle="tab" data-target="<?php echo $id; ?>" class="text-sm-center trans05 <?php if ($key==0) echo 'active show'; ?>" role="tab" onclick="return showTab(this)">
                                <span style="font-size: 18px; font-weight:500">
                                    <?php $this->render_date($day->programme_day); ?>
                                </span>
                            </a>
                        </li>       
                    <?php endforeach; ?>
                </ul>
            </div>
        </div><?php
    } 

    /**
     * 
     * In the future, this function will not recieve the $day parameter
     */
    public function render_categories_panel($day)
    {
        $categories = $this->get_categories();
        
        ?><div class="bg-congress main-text-congress">
            <ul class="nav nav-tabs trans05 align-items-center" style="width: 95%;margin: 0 auto;">
                <?php 
                    foreach($categories as $key => $category) :
                        $tab_key = $key + 1;
                        $tab_href = "#tab-day".$day_key."_category".$tab_key; 
                ?>
                    <li class="trans05 col-6 px-0 col-sm">
                        <a href="<?php echo $tab_href; ?>" data-toggle="tab" class="text-sm-center trans05 <?php if($key == 0) echo 'active show' ?>">
                            <span style="font-size: 18px; font-weight:500">
                                <?php echo $day->programme_day_name ." - ". $category; ?>
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>       
            </ul>
        </div><?php
    }

    public function render_date($date) 
    {
        echo date("l d F Y", strtotime($date));
    }

    /**
     * New methods
     */
    public function get_times()
    {
        $times_array = $this->wpdb->get_results(
            "SELECT DISTINCT start_time FROM $this->programme_table ORDER BY start_time ASC"
        ,ARRAY_A);

        foreach($times_array as $times_key => $times_value) {
            foreach($times_value as $key => $value) {
                $result[] = $value;
            }
        }

        return $result;
    }

    public function create_grid_rows($presentations) {
        $max_hour = 0;
        $min_hour = 50000000;

        foreach($presentations as $presentation) {
            $current_hour = (int)strval(trim(str_replace(':', '', $presentation->start_time)));
            $max_hour = $current_hour > $max_hour ? $current_hour : $max_hour;
            $min_hour = $current_hour < $min_hour ? $current_hour : $min_hour;
        }

        $min_hour = custom_intdiv($min_hour, 100) * 100;

        // This adds height to the last row 
        $max_hour = $max_hour + 40;

        $css .=  '[track] auto ';
        for($i = $min_hour; $i < $max_hour; $i += 5) {
            $time_row = $i < 1000 ? '0'.strval($i) : strval($i);

            // $css .= '[time-'.$time_row.'] 1fr ';
            $css .= '[time-'.$time_row.'] auto ';
        }
        $css .= ';';

        return $css;
    }

    public function get_all_presentations() {
        return $this->wpdb->get_results(
            "SELECT * FROM $this->programme_table ORDER BY start_time ASC"
        );
    }

    // Recieve presentations by day
    public function render_hours($presentations) {
        $max = 0;
        $min = 50000000;

        foreach($presentations as $presentation) {
            $hour = trim(str_replace(':', '', $presentation->start_time));
            $max = $hour > $max ? $hour : $max;
            $min = $hour < $min ? $hour : $min;
        }

        $min = custom_intdiv($min, 100);
        $max = custom_intdiv($max, 100);

        for($i = $min; $i <= $max; $i++) : 
            if($i < 9) {
                $time_start = '0'.strval($i).'00'; 
                $timeEnd =  '0'.strval($i + 1).'00';
            } elseif($i == 9) {
                $time_start = '0'.strval($i).'00'; 
                $timeEnd =  strval($i + 1).'00';
            } else {
                $time_start = strval($i).'00'; 
                $timeEnd =  strval($i + 1).'00';
            }
            $timeRow = 'time-'.$time_start.'/'.'time-'.$timeEnd.';';
            $timeShow = strval($i) < 10 ? '0'.strval($i).':00' : strval($i).':00';

            echo '<div class="time-slot" style="grid-row:'.$timeRow.'"><h3 class="time-span">'.$timeShow.'</h3></div>';
        endfor;
    }

    public function create_grid_columns($presentations) {
        $tracks = [];
        $columns = 1;

        foreach($presentations as $key => $presentation) :
            $start_time = strval(trim(str_replace(':', '', $presentation->start_time)));
            $end_time = strval(trim(str_replace(':', '', $presentation->end_time)));

            $room = false;
            $i = 0;

            while(! $room) {
                if($start_time >= $tracks[$i]) {
                    $tracks[$i] = $end_time;
                    $room = true;
                    $track = $i + 1;
                    $i = 0;
                } else {
                    $i++;
                }
            }
            $columns = $columns < $track ? $track : $columns;
        endforeach;

        $css = '[times] 6em ';
        $css .= '[track-1-start] 1fr ';

        for($i = 1; $i < $columns; $i++) {
            $css .= '[track-'.$i.'-end track-'.($i + 1).'-start] 1fr ';
        }
        $css .= '[track-'.$columns.'-end];';

        return $css;
    }

    public function get_locations() {
        return $this->wpdb->get_results(
            "SELECT DISTINCT room_name FROM $this->programme_table ORDER BY start_time ASC"
        );
    }

    public function create_grid($presentations) {
        $grid['rows'] = $this->create_grid_rows($presentations);
        $grid['columns'] = $this->create_grid_columns($presentations);

        return $grid;
    }
}