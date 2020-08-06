<?php

class Presentation 
{

    private $wpdb;
    private $programme_table;
    private $speakers_table;

    private $session_title;
    private $room;
    private $session_html;
    private $all_chairs;
    private $all_speakers;
    private $session_id;

    // Change to private!!!!!
    public $start_time;
    public $end_time;
    public $track;


    public function __construct($presentation, $wpdb)
    {  
        $this->wpdb = $wpdb;
        $this->programme_table = $wpdb->base_prefix."synclogic_programme";
        $this->speakers_table = $wpdb->base_prefix."synclogic_speakers"; 
        $this->start_time = $presentation->start_time;
        $this->end_time = $presentation->end_time;
        $this->session_title = $presentation->session_title;
        $this->room = $presentation->room_name;
        $this->session_html = $presentation->session_html;
        $this->all_chairs = $presentation->all_chairs;
        $this->all_speakers = $presentation->all_faculties;
        $this->session_id = $presentation->programme_id;
        
    }

    public function get_session_id() {
        return $this->session_id;
    }

    public function get_the_time()
    {
        return $this->start_time. " - " . $this->end_time; 
    }

    public function the_time()
    {
        echo $this->start_time. " - " . $this->end_time; 
    }

    public function time_row()
    {
        $start = trim(str_replace(':', '', $this->start_time)); 
        $end = trim(str_replace(':', '', $this->end_time));
        echo 'time-'.$start.'/'.'time-'.$end;
    }

    public function time_exists()
    {
        return (strcmp ( " 00:00" , $this->start_time ) != 0) && ( strcmp ( " 00:00" , $this->end_time ) != 0); 
    }

    public function session_title()
    {
        echo $this->session_title;
    }

    public function location_exists()
    {
        return (bool)$this->room;
    }

    public function location()
    {
        echo $this->room;
    }

    public function session_html_exists()
    {
        return (bool)$this->session_html;
    }

    public function session_html()
    {
        return $this->session_html;
    }

    public function chairs_exists()
    {
        return strlen($this->all_chairs) > 0;
    }

    public function count_chairs()
    {
        return count($this->get_chairs()) > 1;
    }

    public function faculties_exists()
    {
        return strlen($this->all_speakers) > 0;
    }

    public function count_faculties()
    {
        return count($this->get_faculties()) > 1;
    }
    
    public function get_chairs()
    {
        $parts2 = str_replace(";", ",", $this->all_chairs);
        $parts2 = rtrim($parts2,',');

        return $this->wpdb->get_results("SELECT * FROM $this->speakers_table WHERE speaker_id in ($parts2) ORDER BY speaker_family_name");
    }

    public function get_faculties()
    {
        $parts2 = str_replace(";", ",", $this->all_speakers);
        $parts2 = rtrim($parts2,',');

        return $this->wpdb->get_results("SELECT * FROM $this->speakers_table WHERE speaker_id in ($parts2) ORDER BY speaker_family_name");
    }

    public function list_faculties() {
        foreach($this->get_faculties() as $faculty) {
            $faculties[] =  $faculty->speaker_name.' '.$faculty->speaker_family_name;
        }

        $output['speaker_count'] = count($faculties) > 1 ? 'Speakers: ' : 'Speaker: ';
        $output['speaker_list'] = implode(', ',$faculties);
        return $output['speaker_count'].$output['speaker_list'];
    }

    public function list_chairs() {
        foreach($this->get_chairs() as $chair) {
            $chairs[] =  $chair->speaker_name.' '.$chair->speaker_family_name;
        }

        $output['chair_count'] = count($chairs) > 1 ? 'Chairs: ' : 'Chair: ';
        $output['chair_list'] = implode(', ',$chairs);
        return $output['chair_count'].$output['chair_list'];
    }

    public function render_hours() {
        $first_hour = min($this->times);
        echo $first_hour;die;

        for($i = 6; $i <= 23; $i++) : 
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
            $timeShow = strval($i).':00';
        endfor;
    }

    public function render_columns($columns) {
        $css .=	'grid-template-columns: ';
        $css .= '[times] 6em ';
        $css .= '[track-1-start] 1fr ';

        for($i = 1; $i < $columns; $i++) {
            $css .= '[track-'.$i.'-end track-'.($i + 1).'start] 1fr ';
        }

        $css .= '[track-'.$columns.'-end] 1fr;';
        echo $css;
    }

    public function find_room($rooms) {
        $i = 0;
        $have_room = false;

        $start_time = strval(trim(str_replace(':', '', $this->start_time)));
        $end_time = strval(trim(str_replace(':', '', $this->end_time)));

        while(! $have_room) {
            if($start_time >= $rooms[$i]) {
                $rooms[$i] = $end_time;
                $have_room = true;
                $track = $i + 1;
                $i = 0;
            } else {
                $i++;
            }
        }

        $this->track = $track;
        return $rooms;
    }
}