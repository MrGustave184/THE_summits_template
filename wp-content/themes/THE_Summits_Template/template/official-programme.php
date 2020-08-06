
<?php get_header(); ?>

<?php while (have_posts()) :

    the_post(); ?>

    <?php
    /*
     * Printing the Header (Banner, Color, Video)
     */
    header_by_ID( get_the_ID() );
    ?>

    <?php //get_template_part( 'template/officialpg', 'widget-2' ); ?>
    <?php //get_template_part('template/programme'); ?>
    <?php get_template_part('template/programmeio'); ?>



    <!-- WE NEED TO VERIFY IF THIS EXISTS -->
		<!-- <div id="sponsorship-seven">
        <?php get_template_part( 'template/partners', 'index' ); ?>
		</div>  -->

		<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>

<script>
	function showTab(element) {
		let activeTab = $('.tab-grid.active');
		let target = $(element).data('target');

		if(activeTab) {
			activeTab.removeClass('active');
		}

		$('#' + target).addClass('active');
	}
</script>