<?php
/*
 * Including our own files
 */

include('includes/ACF_custom_styles.php');
include('includes/helpers.php');

/*
 * Removing actions that activates with wp_head Function
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'wp_head',      'rest_output_link_wp_head'              );
remove_action( 'wp_head',      'wp_oembed_add_discovery_links'         );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

/*
 * IF you are NOT using Woocommerce, you may disable this.
 */
// Remove the REST API endpoint.
remove_action( 'rest_api_init', 'wp_oembed_register_route' );
// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );
// Don't filter oEmbed results.
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
// Remove oEmbed discovery links.
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
// Remove all embeds rewrite rules.
//add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites');

/*
 * Removing the admin bar
 */
add_filter('show_admin_bar', '__return_false');


/* Removing Menu Items on the Dashboard */
function remove_menus(){
    //if( !current_user_can( 'administrator' ) ):

    //remove_menu_page( 'index.php' );                  //Dashboard
    //remove_menu_page( 'jetpack' );                    //Jetpack*
    //remove_menu_page( 'edit.php' );                   //Posts
    //remove_menu_page( 'upload.php' );                 //Media
    //remove_menu_page( 'edit.php?post_type=page' );    //Pages
    //remove_menu_page( 'edit-comments.php' );          //Comments
    //remove_menu_page( 'themes.php' );                 //Appearance
    //remove_menu_page( 'plugins.php' );                //Plugins
    //remove_menu_page( 'users.php' );                  //Users
    //remove_menu_page( 'tools.php' );                  //Tools
    //remove_menu_page( 'options-general.php' );        //Settings

    //remove_menu_page( 'edit.php?post_type=acf-field-group' );    //Pages
    //remove_menu_page( 'cptui_manage_post_types' );
    //remove_menu_page('aiowpsec');
    //remove_menu_page('ai1wm_export');
    //remove_menu_page('WP-Optimize');
    //remove_menu_page('synclogic');
    //endif;
}
add_action( 'admin_menu', 'remove_menus' );

function register_my_menus() {
    register_nav_menus(
        array(
            'main-menu' => __( 'Main Menu' ),
            'expansible-menu' => __( 'Expansible Menu' )
        )
    );
}
add_action( 'init', 'register_my_menus' );
//Register Menus

//Add thumbnail to Wordpress Dashboard
add_theme_support( 'post-thumbnails' );
//Add thumbnail to Wordpress Dashboard

//Custom excerpt Size
function wpdocs_custom_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/* Get ID of Pages by its slug.
 * This function is used to get the ID of the Settings Page. and so, been able to use all the features indicated in it. */
function get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
} 


// custom menu example @ https://digwp.com/2011/11/html-formatting-custom-menus/
function clean_custom_menus() {

    global $wp;
    $current_url = home_url( add_query_arg( array(), $wp->request ) );
    $menu_name = 'main-menu'; // specify custom menu slug
    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<nav class="navbar navbar-expand-xl float-right">' ."\n";
        $menu_list .= "\t\t\t\t". '<ul class="navbar-nav">' ."\n";

        $cont = 0;

        foreach( $menu_items as $menu_item ) {

            if( $menu_item->menu_item_parent == 0 ) {

                $parent = $menu_item->ID;

                $menu_array = array();
                foreach( $menu_items as $submenu ) {
                    if( $submenu->menu_item_parent == $parent ) {
                        $bool = true;
                        //echo '<div>1'.wp_make_link_relative($current_url).'</div>';
                        //echo '<div>2'.substr($submenu->url, 0, -1).'</div>';
                        //if( wp_make_link_relative($current_url) == (substr($submenu->url, 0, -1)) ){ echo '<div>Son Iguales!! </div>';}else {echo '<div>No iguales.</div>';}
                        $menu_array[] = '<a class="dropdown-item" target="'.$submenu->target.'" href="' . $submenu->url . '">' . $submenu->title . '</a>' ."\n";
                    }
                }
                if( $bool == true && count( $menu_array ) > 0 ) {

                    $cont = $cont+1;

                    $menu_list .= '<li class="nav-item dropdown nav-item-li-'.$cont.'">' ."\n";
                    $menu_list .= '<a class="nav-link dropdown-toggle nav-item-num-'.$cont.'" href="#" id="navbardrop" data-toggle="dropdown">' . $menu_item->title . ' </a>' ."\n";

                    $menu_list .= '<div class="dropdown-menu text-center">' ."\n";
                    $menu_list .= implode( "\n", $menu_array );
                    $menu_list .= '</div>' ."\n";

                } else {
                    $cont = $cont+1;
                    $menu_list .= '<li class="nav-item nav-item-li-'.$cont.'">' ."\n";
                        $menu_list .= '<a class="'. implode(" ",$menu_item->classes) .' nav-link nav-item-num-'.$cont.'"
                            target="'.$menu_item->target.'"
                            href="' . $menu_item->url . '">
                            ' . $menu_item->title . '</a>' ."\n";
                }

            }

            // end <li>
            $menu_list .= '</li>' ."\n";
        }


        $menu_list .= "\t\t\t\t". '</ul>' ."\n";
        $menu_list .= "\t\t\t". '</nav>' ."\n";
    } else {
        // $menu_list = '<!-- no list defined -->';
    }
    echo $menu_list;
}
//Custom Menu

// custom menu example @ https://digwp.com/2011/11/html-formatting-custom-menus/
function clean_custom_expansible_menus() {

    $menu_name = 'main-menu'; // specify custom menu slug
    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<nav class="navbar navbar-expand-xl navbar-light">' ."\n";
        $menu_list .= "\t".'<a class="navbar-brand" href="#"></a>' ."\n";
        $menu_list .= "\t".'<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">' ."\n";
        $menu_list .= "\t\t".'<span class="navbar-toggler-icon"></span>' ."\n";
        $menu_list .= "\t".'</button>' ."\n";
        $menu_list .= "\t".'<div class="collapse navbar-collapse" id="collapsibleNavbar">' ."\n";
        $menu_list .= "\t\t". '<ul class="navbar-nav">' ."\n";

        $cont = 0;

        foreach( $menu_items as $menu_item ) {

            if( $menu_item->menu_item_parent == 0 ) {

                $parent = $menu_item->ID;

                $menu_array = array();
                foreach( $menu_items as $submenu ) {
                    if( $submenu->menu_item_parent == $parent ) {
                        $bool = true;
                        $menu_array[] = '<a class="dropdown-item" href="' . $submenu->url . '">' . $submenu->title . '</a>' ."\n";
                    }
                }
                if( $bool == true && count( $menu_array ) > 0 ) {

                    $cont = $cont+1;

                    $menu_list .= '<li class="nav-item dropdown ">' ."\n";
                    $menu_list .= '<a class="nav-link dropdown-toggle nav-item-num-'.$cont.' " target="' . $menu_item->target . '" href="#" id="navbardrop" data-toggle="dropdown">' . $menu_item->title . ' </a>' ."\n";


                    $menu_list .= '<div class="dropdown-menu">' ."\n";
                    $menu_list .= implode( "\n", $menu_array );
                    $menu_list .= '</div>' ."\n";

                } else {

                    $cont = $cont+1;

                    $menu_list .= '<li class="'. implode(" ",$menu_item->classes) .' nav-item ">' ."\n";
                    $menu_list .= '<a class="nav-link nav-item-num-'.$cont.'"
                        target="' . $menu_item->target . '"
                        href="' . $menu_item->url . '">
                        ' . $menu_item->title . '</a>' ."\n";
                }

            }

            // end <li>
            $menu_list .= '</li>' ."\n";
        }


        $menu_list .= "\t\t". '</ul>' ."\n";
        $menu_list .= "\t". '</div>' ."\n";
        $menu_list .= "\t". '</nav>' ."\n";
    } else {
        // $menu_list = '<!-- no list defined -->';
    }
    echo $menu_list;
}
//Expansible Menu

function dynSponsorImg($partners,$link) {

    $total = count($partners);

    //Define the number for the bootstrap's grid classes regarding the amount of images.

    if($total < 2)
        $gridAmount = 12;
    else if( $total == 2 || ($total >= 5 && $total <= 8) )
        $gridAmount = 6;
    else if($total == 3 || $total == 9 || $total == 10)
        $gridAmount = 4;
    else if($total == 4 || $total > 10)
        $gridAmount = 3;

    foreach($partners as $key => $partner):

        /*Using $key to know the current item's position and change bootstrap's grid classes
         *based on that to make the images fill in the right order.*/
        if( ($total == 5 && $key > 1 ) || ($total == 10 && $key > 6) || ($total == 11 && ($key > 3 && $key < 6)) ||
            ($total == 7 && ($key > 1 && $key < 5)) )
            $gridAmount = 4;

        elseif( ($total == 6 && $key > 1) || ($total == 10 && $key > 2) || ($total == 11 && $key > 6) || ($total == 8 && ($key > 1 && $key < 5)) )
            $gridAmount = 3;

        elseif( ($total == 7 && $key > 4) || ($total == 8 && $key > 5) )
            $gridAmount = 6;

        //ADD bootstrap's alignment classes if there're only 2 items in the first or last row.
        if($gridAmount == 6) {
            if($key == 0 || ($total == 7 && $key == 5) || ($total == 8 && $key == 6) )
                $extra = 'text-right ';
            elseif($key == 1 || ($total == 7 && $key == 6) || ($total == 8 && $key == 7) )
                $extra = 'text-left ';
        } else $extra = '';

        //Add class sponsor for changes in CSS ?>

        <div class="<?= $extra . 'col-12 col-sm-' . $gridAmount . ' col-md-' . $gridAmount; ?> sponsor">
            <a href="<?= $link ?>">
                <img src="<?= $partner['image'] ?>" alt="partner-<?= $key; ?>" width="" height="">
            </a>
        </div> <?php

    endforeach;
} //dynSponsorImg

/* Printing the Header by the Page ID*/
function header_by_ID($id) {
    //echo $id;
    if ($id){
        $header = "";
            // If it is a Color background
            if( get_field('type_of_background',$id) == 1 ) {
                $background = get_field('v3_header_background_color', $id);
                $header = "<div id=\"one\" style=\"background-color: $background;\">";
            }
            // if it is an Image background
            elseif ( get_field('type_of_background',$id) == 2 ){
                $image = get_field('v3_header_background_image',$id);
                $url = "url('$image');
				 background-repeat: no-repeat;
				 background-position: center center;
				 background-size: cover;";
                $header = "<div id=\"one\" style=\"background: $url ;\">";
            }
            // If it is a Video Background
            elseif ( get_field('type_of_background',$id) == 3 ){

                // If origin is an URL
                if ( get_field('v3_header_video_origin', $id) == 1){
                    $webm = get_field('v3_header_video_url_webm', $id);
                    $mp4 = get_field('v3_header_video_url_mp4', $id);
                    $ogg = get_field('v3_header_video_url_ogg', $id);
                }
                // If origin is an Internal Video File
                elseif ( get_field('v3_header_video_origin', $id) == 2 ){
                    $webm = get_field('v3_header_video_file_webm', $id);
                    $mp4 = get_field('v3_header_video_file_mp4', $id);
                    $ogg = get_field('v3_header_video_file_ogg', $id);
                }

                $video = "<video id=\"bgvid\" autoplay loop muted poster playsinline=\"\">
                                <source src=\"$webm\" type=\"video/webm\">
                                <source src=\"$mp4\" type=\"video/mp4\">
                                <source src=\"$ogg\" type=\"video/ogg\">
                              </video>";

                $header = "<div id=\"one\">";
                $header .= $video;
            }

        $header .= "<div class=\"container\">";
        $header .= "<div class=\"row\">"; // row 1
        $header .= "<div class=\"col-12 banner\">"; // col 1

        // If we have a Banner
        if( $banner = get_field('banner',$id) ){
            $header .= "<img class=\"img-fluid mx-auto d-block\" src=\"$banner\" alt=\"home-banner\">";
        }

        $header .= "</div>"; // closing col 1
        $header .= "</div>"; // closing row 2
        $header .= "<div class=\"row\">"; // row 2
        $header_text_color = get_field('header_text_color',$id);
        $header .= "<div class=\"col-12 text-center\" style=\"color: $header_text_color !important;\">"; // Col 2

        //if we have Title and Subtitles
        $title = get_field('main_title',$id);
        $subtitle = get_field('sub_title',$id);
        $header .= "<h1><strong> $title </strong></h1>";
        $header .= "<h2> $subtitle </h2>";

        $header .= "</div>"; // closing col 2
        $header .= "</div>"; // closing row 2
        $header .= "<div class=\"row justify-content-center\">"; // row 3

        // Calling Buttons Function
        if ( get_field('v3_header_buttons',$id) != 0 ) {
            $buttons = header_button_by_ID($id);
            $header .= $buttons;
        }

        $header .= "</div>"; // closing row 3
        $header .= "</div>"; // closing the container
        $header .= "</div>"; //closing div one

        echo $header;
    } else {
        echo '<!-- no list defined -->';
    }
} // Header_by_ID

function header_button_by_ID($id) {
    $buttons = "";
    // 1 Button
    // By Default, if we are into this function, means that AT LEAST we have one button.

    // If we only have one Button
    if ( get_field('v3_header_buttons',$id) == 1 ){
        $buttons .= "<div class=\"col-2 text-center\">"; // Open col 1
        $buttons .= giveMeButton(1,$id);
        $buttons .= "</div>"; // Close col 1

    }
    // If we have two buttons
    elseif( get_field('v3_header_buttons',$id) == 2 ){
        $buttons .= "<div class=\"col-12 pb-4 col-md-2 text-center\">"; // Open col 1
        $buttons .= giveMeButton(1,$id);
        $buttons .= "</div>"; // Close col 1

        $buttons .= "<div class=\"col-12 col-md-2 text-center\">"; // Open col 2
        $buttons .= giveMeButton(2,$id);
        $buttons .= "</div>"; // Close col 2
    }

    return $buttons;
}// End of header_button_by_ID

/*
* Function that gives the button code
*/
function giveMeButton($num,$id){

    $buttons = "";

    // If Type Button is URL
    if( get_field('v3_button_'.$num.'_type', $id) == 1 ) {
        $link = get_field('v3_button_'.$num.'_url',$id);
        if( $link ):
            $link_url = esc_url( $link['url']); $link_title = $link['title']; $link_target = $link['target'] ? $link['target'] : '_self';
            $link_target = esc_attr( $link_target );

            $buttons .= "<a class=\"btn btn-congress\" href=\"$link_url\" target=\"$link_target\">$link_title</a>";
        endif;
    }
    // If it is a PopUp Button or a Download File, this text will be use.
    $text = get_field('v3_button_'.$num.'_text',$id);

    // If Type Button Pop Up
    if( get_field('v3_button_'.$num.'_type',$id) == 2 ){

        $buttons .= "<!-- Button trigger modal -->
            <a class=\"btn btn-congress\" data-toggle=\"modal\" data-target=\"#ModalButton$num\">
              $text
            </a>
            
            <!-- Modal -->
            <div class=\"modal fade\" id=\"ModalButton$num\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ModalButton$num-Label\" aria-hidden=\"true\">
              <div class=\"modal-dialog\" role=\"document\">
                <div class=\"modal-content\">
                  <div class=\"modal-body\">";

        if( get_field('v3_button_'.$num.'_popup_type',$id) == 3 ){
            $webm = get_field('v3_button_'.$num.'_popup_internal_webm', $id);
            $mp4 = get_field('v3_button_'.$num.'_popup_internal_mp4', $id);
            $ogg = get_field('v3_button_'.$num.'_popup_internal_ogg', $id);
            $buttons .= "<video controls width='100%' height='450px'>
                            <source src=\"$webm[url]\" type=\"video/webm\">
                            <source src=\"$mp4[url]\" type=\"video/mp4\">
                            <source src=\"$ogg[url]\" type=\"video/ogg\">
                          </video>";
        }elseif ( get_field('v3_button_'.$num.'_popup_type',$id) == 1 ){
            $video_id = get_field('v3_button_'.$num.'_popup_youtube',$id);
            $buttons .= "<iframe width=\"100%\" height=\"450px\"
                                        src=\"https://www.youtube-nocookie.com/embed/$video_id?rel=0\"
                                        frameborder=\"0\" allow=\"autoplay; encrypted-media\"
                                        allowfullscreen></iframe>";
        }else{
            $video_id = get_field('v3_button_'.$num.'_popup_vimeo',$id);
            $buttons .= "<iframe src=\"https://player.vimeo.com/video/$video_id\" width=\"100%\" height=\"450\" frameborder=\"0\" allowfullscreen></iframe>";
        }


        $buttons .= "
                    </div>
                </div>
              </div>
            </div>";
    }

    // If Type Button File
    if( get_field('v3_button_'.$num.'_type', $id) == 3 ) {
        $file = get_field('v3_button_'.$num.'_download',$id);
        if( $file ):
            $file_url = $file['url']; $file_name = $file['filename'];
            $buttons .= "<a class=\"btn btn-congress\" href=\"$file_url\" target=\"_blank\" download=''>$text</a>";
        endif;
    }

    return $buttons;

}// End of giveMeButton

/*
 * Login Page logo 
 */
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(/sandboxes/general_sandbox/wp-content/uploads/2019/07/THE-Logo-1-e1563907547824.jpg);
		background-size: contain;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
			width: 100%;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/*
 * CUSTOM POST TYPES
 */
function customposttypes_register_partners() {

	/**
	 * Post Type: partners.
	 */

	$labels = [
		"name" => __( "partners" ),
		"singular_name" => __( "partners" ),
		"menu_name" => __( "Partners" ),
	];

	$args = [
		"label" => __( "partners"),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "partners", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 5,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "partners", $args );
}

add_action( 'init', 'customposttypes_register_partners' );

function custom_intdiv($a, $b) {
    $a = (int) $a;
    $b = (int) $b;
    return ($a - fmod($a, $b)) / $b;
}