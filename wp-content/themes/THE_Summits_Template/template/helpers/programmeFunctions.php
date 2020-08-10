<?php
// -------------------- ISSUES ------------------------------------
// chair/speakers that appears several times through the programme and rendering several times


// -------------------- VARIABLES ------------------------------------

global $programme_table; 
global $speakers_table; 

$programme_table = $wpdb->base_prefix."synclogic_programme";
$speakers_table = $wpdb->base_prefix."synclogic_speakers";


// ---------------------- HELPERS ------------------------------

function isContentValid($content, $allowedTags) {
    return (bool)trim(str_replace('&nbsp;','',strip_tags($content, $allowedTags))) != '';
}

function postHaveContent() 
{
    global $post;
    
	$content = $post->post_content;
	$allowedTags = ['<img>'];

    return isContentValid($content, $allowedTags);
}

// Think of a better name
function formatProgrammeDate(string $date, string $format) {
    return date($format, strtotime($date));
}


// ---------------------- FUNCTIONS ------------------------------

function getSessionDays()
{
    global $wpdb;
    global $programme_table;

    return $wpdb->get_results(
        "SELECT DISTINCT programme_day_name, programme_day FROM $programme_table ORDER BY programme_day ASC"
    );
}

function isSelectedDay(int $counter) {
    return $counter == 0;
}

function getPresentationsByDay($day) {
    global $wpdb;
    global $programme_table;

    return $wpdb->get_results(
        "SELECT * FROM $programme_table WHERE programme_day = '$day' ORDER BY cast(REPLACE(start_time, ':', '') as unsigned)"
    );
}


// Model and controller in the same file?

// Model
function getFromDatabase() {
    return 'I got this from the database';
}

// Controller
// El controlador va a pasar todos los datos necesarios para la vista
function ProgrammeController() {
    return 'retorna la vista';
}

