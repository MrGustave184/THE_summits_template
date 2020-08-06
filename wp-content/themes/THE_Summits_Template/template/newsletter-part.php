
<div class="container">
    <?php
    $settings_page_id = get_id_by_slug('settings');
    ?>
    <div class="row text-center">
        <div class="col-12 pt-3">
            <?php the_field('newsletter_title',$settings_page_id);?>
			<?php the_field('newsletter_sub_title',$settings_page_id);?>
        </div>
        <div class="col-12 pt-5">
            <?php
            $link = get_field('newsletter_button',$settings_page_id);
            if( $link ):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="btn btn-1" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>