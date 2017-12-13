<?php //get_template_part('monfooter'); ?>
<footer class="row" id="widget">
    <?php get_template_part('widget'); ?>
<?php if(!is_single()):?>
                    <?php if(is_home() && get_field('partenaires', 'option')):?>
                    <div id="partenaires" class="col-md-12">
                        <?php 
                        $partenaires = get_field('partenaires', 'option');
                        //print_r($partenaires[sizes]);
                        ?>
                        <figure class="col-sm-3">
                            <a href="<?php echo the_field('lien_partenaires','option'); ?>">
                            <img src="<?php echo $partenaires[sizes][medium_large]; ?>" alt="<?php echo $partenaires[alt]; ?>" />
                            </a>
                        </figure>
                        <div class="col-sm-9">
                            <?php the_field('texte_partenaires', 'option'); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                            <div class="hidden-xs hidden-sm hidden-lg hidden-md">
                                    <nav>
                                            <?php wp_nav_menu(array(
                                    'theme_location' => 'troisieme',
                                    'walker' => new Bootstrap_Walker_Nav_Menu(),
                                    'menu_class' => 'nav navbar-nav col-sm-12'
                            ) );
                            ?>
                                    </nav>
                            </div>
                            
                            <div class="hidden-xs hidden-sm hidden-lg hidden-md text-center">

                                    <p class="sub">
                                            <?php if(get_field('texte_footer','option')){the_field('texte_footer','option');$titre=get_field('texte_footer','option');}else{echo '&copy; Copyright 2017 Ticoët - Tous droits reservés';} ?>
                                    </p>
                            </div>

                            
				<?php wp_footer(); ?>
			</footer>
	<?php else:?><?php wp_footer();endif; ?>
		</footer>
        <?php if(is_home()) :?>
        <script>
			$(document).ready(function() {
				$(".owl-item .box > a").removeClass( "swipebox" );
			});
			$(window).load(function() {
				 // executes when complete page is fully loaded, including all frames, objects and images
				 //alert("window is loaded");
				 //$(".owl-item .box > a").removeClass( "swipebox" );
			});
		</script>
		<?php endif; ?>
		<?php
		if ( is_admin_bar_showing() ) {?>
		    <style>
		    	@media screen and (min-width: 768px){
		    		body > nav.navbar-default{
                                    top: 32px !important;
		    		}
                                header#top nav.logo{
                                    top: 32px !important;
                                }
		    	}
		    </style>
		<?php }
		?>
                    <script>
    $(window).scroll(function () {   
            if ($(window).scrollTop() > $( "header#top > div" ).height()) {
                $('header#top nav').css('position', 'fixed').css('top', '0').addClass('logo');
            } else {
                $('header#top nav').css('position', 'relative').removeClass('logo');
            }
        });
                    </script>
	</body>
</html>