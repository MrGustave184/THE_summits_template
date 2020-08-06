<?php

// -------------------- VARIABLES ------------------------------------

global $programme_table; 
global $speakers_table; 

$programme_table = $wpdb->base_prefix."synclogic_programme";
$speakers_table = $wpdb->base_prefix."synclogic_speakers";


// ---------------------- HELPERS ------------------------------

function isContentValid($content, $allowedTags) {
    return (bool)trim(str_replace('&nbsp;','',strip_tags($content, $allowedTags))) != '';
}


// ---------------------- FUNCTIONS ------------------------------

function postHaveContent() 
{
    global $post;
    
	$content = $post->post_content;
	$allowedTags = ['<img>'];

    return isContentValid($content, $allowedTags);
}

function getSessionDays()
{
    global $wpdb;
    global $programme_table;

    return $wpdb->get_results(
        "SELECT DISTINCT programme_day_name, programme_day FROM $programme_table ORDER BY programme_day ASC"
    );
}

function isSelectedDay($counter) {
    return $counter == 0;
}

// Think of a better name
function formatDate($date) {
    return date("l d F Y", strtotime($date));
}

function getPresentationsByDay($day) {
    global $wpdb;
    global $programme_table;

    return $wpdb->get_results(
        "SELECT * FROM $programme_table WHERE programme_day = '$day' ORDER BY cast(REPLACE(start_time, ':', '') as unsigned)"
    );
}