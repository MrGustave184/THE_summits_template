<!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php
    $settings_page_id = get_id_by_slug('settings');
	//echo get_id_by_slug('settings');
	
if( get_field('google_tag_manager', $settings_page_id) == 2)
		{ echo get_field('google_tag_manager_head_text', $settings_page_id); }
	?>
	<?php $favicon = get_field('fav_icon',$settings_page_id);?>
	
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> <?php bloginfo( 'name' ); ?> </title>
    
    <!-- Timelines CSS -->
    <!--link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/styles_timeline.css" -->
	<!--link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/styles_JB2.css" --> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/bootstrap.min.css">

    <!-- Natural Stylesheet -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/style.css">

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="<?php echo $favicon; ?>">
    <link rel="icon" type="image/png"  href="<?php echo $favicon; ?>">
	
	<!-- Google Fonts Lato -->
	<style>
	/* @import url('https://fonts.googleapis.com/css?family=Lato'); */
	</style>

    <!-- Font Awesome Kit -->
    <!-- <script src="https://kit.fontawesome.com/c46611ef3f.js" crossorigin="anonymous"></script> -->
	
    <?php
    wp_head();
    ?>
</head>
<body>
	<?php if(get_field('google_tag_manager', $settings_page_id) == 2) { echo get_field('google_tag_manager_body_text', $settings_page_id); }?>

<?php
    // Congress Logo
    $congress_logo = get_field('congress_logo', $settings_page_id);
    //Colors of the congress and main buttons
    $main_congress_color = get_field('main_congress_color', $settings_page_id);
    $main_text_color = get_field('main_text_color', $settings_page_id);
    $first_button_text_color = get_field('first_button_text_color', $settings_page_id);
    $first_button_background_color = get_field('first_button_background_color', $settings_page_id);
    $second_button_text_color = get_field('second_button_text_color', $settings_page_id);
    $second_button_background_color = get_field('second_button_background_color', $settings_page_id);

    //Date and Location of the congress
    $congress_date = get_field('congress_date',$settings_page_id);
    $congress_location = get_field('congress_location',$settings_page_id);

    //Date and Location of the congress
    $newsletter_bg = get_field('newsletter_form_background_image',$settings_page_id);
    $newsletter_text = get_field('newsletter_form_text',$settings_page_id);

?>

<style>
	.btn-1, .btn-1:hover {
		color: <?php echo $first_button_text_color ?> !important;
		background-color: <?php echo $first_button_background_color ?> ;
        border-color:  <?php echo $first_button_background_color ?> ;
	}

	.btn-2, .btn-2:hover {
		color: <?php echo $second_button_text_color ?> !important;
		background-color: <?php echo $second_button_background_color ?> ;
        border-color: <?php echo $second_button_background_color ?> ;
	}

    .btn-congress, .btn-congress:hover {
        color: <?php echo $main_text_color; ?> !important;
        background-color: <?php echo $main_congress_color ?> !important;
        border-color:  <?php echo $main_congress_color ?> !important;
    }
	
	.cd-h-timeline__date--selected::after{
		border-color: <?php echo $main_congress_color ?> !important;
	}
	
	.cd-h-timeline__date--older-event::after{
		border-color: <?php echo $main_congress_color ?> !important;
	}
	
	.cd-h-timeline__filling-line{
		background-color: <?php echo $main_congress_color ?> !important;
	}
	
	.cd-h-timeline__navigation:hover{
		border-color: <?php echo $main_congress_color ?> !important;
	}

    .color-congress, .color-congress:hover, #faqs-two #accordion .card .card-body a, a, a:hover {
        color: <?php echo $main_congress_color; ?>;
    }
    .bg-congress {
        background-color: <?php echo $main_congress_color ?> ;
    }

    .border-congress {
        border: 1px solid <?php echo $main_congress_color ?>;
    }
    #sponsorship-six .form input:focus  {
        border: 1px solid <?php echo $main_congress_color ?>;   
    }

    .main-text-congress {
        color: <?php echo $main_text_color; ?> !important;
    }

    .newsletter-settings, .newsletter-settings a {
        color: <?php echo $newsletter_text; ?>;
    }
    .newsletter-settings {
        background: url(" <?php echo $newsletter_bg ?> ") no-repeat center center;
        background-size: cover;
    }

    hr {
        background-color: <?php echo $main_congress_color; ?>;
    }

</style>

	<header>
		<section id="main-menu">
			<div class="container-fluid">
				<div class="row align-items-center text-center">
					<div class="col-xl-3 col-md-12">
                        <div class="container-fluid">
                            <div class="row align-items-center no-gutters">
                                <div class="logo col-xl-2">
                                    <a href="<?php the_field('main_logo_url', $settings_page_id)?>">
                                        <img src="<?php echo $congress_logo ?>" alt="logo">
                                    </a>
                                </div>
                                <div class="col-xl-10 text-left">
                                    <div class="text1"><?php echo $congress_date ?></div>
                                    <div class="text2"><?php echo $congress_location ?></div>
                                </div>
                            </div>
                        </div>
					</div>

					<div class="col-xl-9 col-md-12">
						<?php clean_custom_menus(); ?>
					</div>
				</div>
			</div>
		</section>

		<section id="expansible-menu">
			<div class="container-fluid">
				<div class="row align-items-center no-gutters">

					<div class="col-9">
						<div class="container-fluid">
							<div class="row align-items-center no-gutters">
								<div class="logo col-2 text-center">
									<a href="<?php the_field('main_logo_url', $settings_page_id)?>">
                                        <img src="<?php echo $congress_logo ?>" alt="logo">
                                    </a>
								</div>
								<div class="col-10">
									<div class="text1"><?php echo $congress_date ?></div>
									<div class="text2"><?php echo $congress_location ?></div>
								</div>
							</div>
						</div>

					</div>

					<div class="col-3">
						<?php clean_custom_expansible_menus(); ?>
					</div>

				</div>

			</div>

		</section>
	</header>