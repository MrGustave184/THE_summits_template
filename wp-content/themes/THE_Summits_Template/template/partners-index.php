<?php
    $settings_page_id = get_id_by_slug('settings');

if ( get_field('enable_partner_section', $settings_page_id)) { ?>
	<!-- Row Partners -->
	<?php if( !is_front_page() && !is_page('faqs') ) echo "<hr class='meta-border'>"; ?>

	<div class="container">
	<?php
    global $wp_query, $partners;
    $cont = 0;
    $wp_query = new WP_Query("post_type=partners&posts_per_page=1&offset=0&post_status=publish&order=asc");
    while ($wp_query->have_posts()) {
        $wp_query->the_post(); ?>

        <!-- Row Partners -->
        <div class="row text-center">
            <div class="col-12 pt-4">
                <h3><?php the_field('section_label'); ?></h3>
                <hr>
            </div>


            <?php

            if ($partners = get_fields()['sections_partners']) {
                $link = get_field('sponsors_link', $settings_page_id);
                dynSponsorImg($partners, $link);
            }
            ?>

        </div>
        <!-- Row Partners -->
		</div>
        <?php
    };
    wp_reset_query();
}
?>
