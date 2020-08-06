<?php if( !is_front_page() ) echo "<hr class='meta-border'>"; ?>
 
<footer>

<?php 
  $footer = (get_id_by_slug('footer')); ?>

        <div id="footer-widget">
            <div class="container">
                <div class="row justify-content-center">
                    <?php for ($i=1; $i <4 ; $i++) { ?> 
                        <?php if($i == 1) { ?>
                        <div class="col-12 col-md-4 offset-md-1 text-center text-md-left"> <?php }?>
                        <?php if($i == 2) { ?>
                        <div class="col-12 col-md-4 text-center text-md-left mt-5 mt-md-0"> <?php }?>
                        <?php if($i == 3) { ?>
                        <div class="col-12 col-md-3 text-center text-md-left mt-5 mt-md-0"> <?php }?>
                            <h5><strong><?php the_field($i.'_column_title',$footer); ?></strong></h5>
                            <hr class="ml-md-0 text-md-left">
                            <div class="footer-widget-list">

                                <?php if($i == 3) { ?>
                                    <div class="container">
                                        <div class="row">
                                <?php } ?>

                                <?php
                                // loop through the rows of data
                                while ( have_rows($i.'_column_links',$footer) ) : the_row();
                                    if( get_row_layout() == 'link' ){
                                    ?>
                                    <?php 
                                    $link = get_sub_field('url');
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';

                                    ?>
                                        <div class="mb-1 <?php if($i == 3) { echo'col-6 col-md-3 col-lg-2 p-0'; }?>">
                                            <a target="<?php echo esc_attr($link_target); ?>"
                                                class="<?php if($i == 3) { echo 'btn-congress main-text-congress'; }?>"
                                                href="<?php echo esc_url($link_url); ?>">
                                                <?php echo $link_title; ?>
                                <?php if(get_sub_field('icon') == 1){ echo "<i class=\"fab fa-facebook-f\"></i>"; }?>
                                <?php if(get_sub_field('icon') == 2){ echo "<i class=\"fab fa-twitter\"></i>"; }?>
                                <?php if(get_sub_field('icon') == 3){ echo "<i class=\"fab fa-linkedin-in\"></i>"; }?>
                                <?php if(get_sub_field('icon') == 4){ echo "<i class=\"fab fa-youtube\"></i>"; }?>
                                <?php if(get_sub_field('icon') == 5){ echo "<i class=\"fab fa-instagram\"></i>"; }?>
                                <?php if(get_sub_field('icon') == 6){ echo "<i class=\"fab fa-flickr\"></i>"; }?>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                endwhile;
                                ?>

                                <?php if($i == 3) { ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                    <?php }?>
                </div>
            </div>
        </div>

    </footer>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?php echo get_template_directory_uri() ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/js/popper.min.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/js/bootstrap.min.js"></script>
    
    <!-- OPEN Registration Forms Spinner Scripts -->
    <script type="text/javascript">
    
        $( window ).on( "load", function() {
            //console.log( "window loaded" );
            //alert("window loaded");
            jQuery("#cover").fadeOut();
        });
        
    </script>
    <!-- CLOSE Registration Forms Spinner Scripts -->
            
    <script>
        $("#exampleModal").on('hidden.bs.modal', function (e) {
            $("#exampleModal iframe").attr("src", $("#exampleModal iframe").attr("src"));
        });

        $("#ModalButton1").on('hidden.bs.modal', function (e) {
            $("#ModalButton1 iframe").attr("src", $("#ModalButton1 iframe").attr("src"));
        });
    </script>
	

	<script>

var script = document.createElement("script");
script.type  = "text/javascript";
script.src   = "https://www.googletagmanager.com/gtag/js?id=UA-172859911-2";
document.head.appendChild(script);

var script = document.createElement("script");
script.type  = "text/javascript";
script.innerHTML = "window.dataLayer = window.dataLayer || []\;function gtag(){dataLayer.push(arguments);\}gtag('js', new Date())\;gtag('config', 'UA-172859911-2');";
document.head.appendChild(script);

	</script>

<?php wp_footer(); ?>
    </body>
</html>