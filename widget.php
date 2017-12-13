    <div class="hidden-xs hidden-sm col-md-3" id="sidebar1">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_1') ) : ?><?php endif; ?>
    </div>
    <div class="hidden-xs hidden-sm col-md-3" id="sidebar2">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_2') ) : ?><?php endif; ?>
    </div>
    <div class="hidden-xs hidden-sm col-md-3" id="sidebar3">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_3') ) : ?><?php endif; ?>
    </div>
    <div class="hidden-xs hidden-sm col-md-3" id="sidebar3">
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
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_4') ) : ?><?php endif; ?>
    </div>