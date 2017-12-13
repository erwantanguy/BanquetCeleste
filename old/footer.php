<?php //get_template_part('monfooter'); ?>
<?php //get_template_part('widget'); ?>
<?php if(!is_single()):?>
		<footer id="bottom" class="row">
                            <div class="col-md-12">
                                <?php if(get_field('texte', 'option')):?>
                                    <h2 class="text-center"><?php the_field('texte', 'option'); ?></h2>
                                <?php endif;?>
                                <?php if( get_field('afficher', 'option') ): ?>
                                <ul class="nav navbar-nav social-links navbar-center">
                                    <?php //var_dump(get_field('compte', 'option'));?>
                                    <?php while ( have_rows('compte', 'option') ) : the_row(); ?>
                                    <?php if( get_row_layout() == 'facebook' ){?>
							<li rel="facebook socialmedia"><a href="<?php echo get_sub_field('facebook'); ?>" data-toggle="tooltip" data-placement="top" title="Facebook <?php bloginfo('name'); ?>"><i class="fa fa-facebook"></i></a></li>
                                    <?php }?>
                                    <?php if( get_row_layout() == 'twitter' ){?>
                                                        <li rel="twitter"><a href="<?php echo get_sub_field('twitter'); ?>" data-toggle="tooltip" data-placement="top" title="Twitter <?php bloginfo('name'); ?>"><i class="fa fa-twitter"></i></a></li>
                                    <?php }?>
                                    <?php if( get_row_layout() == 'newsletter' ){?>
                                                        <li rel="newsletter"><a href="<?php echo get_sub_field('newsletter'); ?>" data-toggle="tooltip" data-placement="top" title="Inscrivez-vous à notre Newsletter <?php bloginfo('name'); ?>"><i class="fa fa-envelope"></i></a></li>
                                    <?php }?>
                                    <?php if( get_row_layout() == 'proaccess' ){?>
                                                        <li rel="proaccess"><a href="<?php echo get_sub_field('proaccess'); ?>" data-toggle="tooltip" data-placement="top" title="Accès à la page destinée aux professionnels"><i class="fa fa-lock"></i></a></li>
                                    <?php }?>
                                    <?php if( get_row_layout() == 'youtube' ){?>
                                                        <li rel="youtube"><a href="<?php echo get_sub_field('youtube'); ?>" data-toggle="tooltip" data-placement="top" title="Youtube <?php bloginfo('name'); ?>"><i class="fa fa-youtube"></i></a></li>
                                    <?php }?>
                                    <?php endwhile; ?>
                                </ul>
	
<?php endif; ?>
                            </div>
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
	<?php else:wp_footer();endif; ?>
		</div>
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