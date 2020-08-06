<?php
    if (get_field('enable_statistics') ) {
        $hero = get_field('statistics_group');

        if( $hero ) : ?>
            <div id="two">
                <div class="container">
                    <div class="row align-items-center text-center">
                        <?php for ($x = 1; $x < 5; $x++) {
                            ?>
                            <div class="col-md-3 col-sm-6 col- col-sm-12 stats">
                                <h1 class="description color-congress">
                                    <strong> <?php echo $hero['statics_description_' . $x]; ?> </strong></h1>
                                <h5 class="title"> <?php echo $hero['statics_title_' . $x]; ?> </h5>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
            <?php
        endif;

        if ($hero['statics_background'] == 0) {
            $background2 = $hero['statics_background_color'];
        } else {
            $bgimg2 = $hero['statics_background_image'];
            $background2 = 'URL(' . $bgimg2 . ')';
        } ?>

        <style type="text/css">
            #two {
                background: <?php echo $background2; ?>;
                background-position: center center;
                background-size: cover;
                background-repeat: no-repeat;
            }
        </style>

        <?php
    }//Enable Statistics ?>