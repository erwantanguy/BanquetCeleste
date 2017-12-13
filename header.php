<?php
  if ( !isset($_COOKIE['modale']) && is_home() ) {
     setcookie("modale", "Banquet Céleste", time()+3600*24);
  }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>
			<?php 
				if(is_home() || is_front_page()) :
					bloginfo('name');
				else :
					wp_title("", true);
				endif;
			?>
		</title>
		<meta name="author" content="Jérôme Pellerin">
		<meta property="fb:admins" content="100009528190403" />
		<?php $date = new DateTime();//echo $date;?>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?ver=<?php echo $date->format('H\hi\ms')?>" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
                <?php add_theme_support( 'automatic-feed-links' ); ?>   
		<?php wp_head(); ?>
		<?php if ( is_home() ){ 
			if( get_field('image_à_la_une','option') ) {?>
				<?php 
				$image = get_field('image_à_la_une','option');
				//print_r($image); ?>
			<meta property="og:image" content="<?php echo $image[url]; ?>" />
			<meta property="og:image:width" content="<?php echo $image[width]; ?>" />
			<meta property="og:image:height" content="<?php echo $image[height]; ?>" />
			<meta name="twitter:image" content="<?php echo $image[url]; ?>" />
		<?php } } ?>
                        <?php if(get_field('zigouigoui', 'option')): $zigouigoui = get_field('zigouigoui', 'option');?>
                        <style>
                            body > footer .row::before{
                                content:url(<?php echo $zigouigoui[url]; ?>);
                            }
                        </style>
                        <?php endif; ?>
                        <?php if(get_header_image()) :?>
                        <style>
                            @media screen and (min-width: 768px){
                                body {
                                    background-attachment: fixed;
                                    background-image: url("<?php echo get_header_image(); ?>");
                                    background-position: center 0;
                                    background-repeat: no-repeat;
                                }
                            }
                        </style>
                        <?php endif; ?>
	</head>

	<body <?php body_class(); ?> id="top">
            <div class="container">
        <header id="top">
            <div class="row">
                <?php $image = get_field('logo', 'option');//[sizes][medium]?>
                <?php //print_r($image[sizes]); ?>
                <div id="logo" class="col-md-12"><a href="<?php bloginfo('url'); ?>"><?php if(!$image){bloginfo('name');} else{echo'<img src="'.$image[url].'" alt="'.$image['alt'].'" class="logo" />';} ?></a></div>
                <div id="title" class="hidden"><span><?php bloginfo('name'); ?></span><?php echo html_entity_decode(get_bloginfo('description'));//bloginfo('description'); ?></div>
            </div>
            <div id="menu">
            <nav class="navbar navbar-default">
			
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	          <button aria-expanded="false" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand visible-xs-block" href="#">Menu</a>
	        </div>
	        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
	          <?php wp_nav_menu(array(
					'theme_location' => 'premier',
					'container'         => 'div',
                	'container_class'   => '',
        			'container_id'      => '',
                	'menu_class'        => 'nav navbar-nav navbar-center',
                	'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                	'walker' => new Bootstrap_Walker_Nav_Menu(),
				) );
				?>
			<?php wp_nav_menu(array(
					'theme_location' => 'deuxieme',
					'container'         => 'div',
                	'container_class'   => '',
        			'container_id'      => '',
                	'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					'walker' => new Bootstrap_Walker_Nav_Menu(),
					'menu_class' => 'nav navbar-nav navbar-right'
				) );
				?>
                    <ul class="social-links nav navbar-nav">
						<?php if(get_option('facebook')){?>
							<li><a href="<?php echo get_option('facebook'); ?>" title="Facebook <?php bloginfo('name'); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<?php }?>
						<?php if(get_option('twitter')){?>
							<li><a href="<?php echo get_option('twitter'); ?>" title="Twitter <?php bloginfo('name'); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<?php }?>
						<?php if(get_option('google')){?>
							<li><a href="<?php echo get_option('google'); ?>" title="Google+ <?php bloginfo('name'); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
						<?php }?>
						<?php if(get_option('instagram')){?>
							<li><a href="<?php echo get_option('instagram'); ?>" title="Instagram <?php bloginfo('name'); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
						<?php }?>
						<?php if(get_option('pinterest')){?>
							<li><a href="<?php echo get_option('pinterest'); ?>" title="Pinterest <?php bloginfo('name'); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
						<?php }?>
						<?php if(get_option('flickr')){?>
							<li><a href="<?php echo get_option('flickr'); ?>" title="Flickr <?php bloginfo('name'); ?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
						<?php }?>
						<?php if(get_option('spotify')){?>
							<li><a href="<?php echo get_option('spotify'); ?>" title="Spotify <?php bloginfo('name'); ?>" target="_blank"><i class="fa fa-spotify"></i></a></li>
						<?php }?>
                                                <?php if(get_option('linkedin')){?>
							<li><a href="<?php echo get_option('linkedin'); ?>" title="LinkedIn <?php bloginfo('name'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
						<?php }?>
                                                <?php if(get_option('tumblr')){?>
							<li><a href="<?php echo get_option('tumblr'); ?>" title="Tumblr <?php bloginfo('name'); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
						<?php }?>
						<?php if(get_option('mail')){?>
							<li class="mail hidden-md"><a href="<?php echo get_option('mail'); ?>" title="Mail à <?php bloginfo('name'); ?>" target="_blank"><i class="fa fa-envelope-o"></i></a></li>
						<?php }?>
					</ul><!-- data-toggle="tooltip" data-placement="bottom"  -->
                </div>
        </nav>
        </div>
</header>
<?php //print_r($_COOKIE); ?>
<?php
if(!isset($_COOKIE['modale']) && is_home() ):
    $value = 'Banquet Céleste';
    setcookie("TestCookie", $value);
    if( get_field('activation', 'options') ):
        if(get_field('modale', 'options')):?>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><a href="<?php the_field('linkmodale','options'); ?>"><?php the_field('titre_modale','options');?></a></h4>
                                    </div>
                                    <div id="texte" class="col-sm-12">
                                        <?php the_field('modale','options');?>
                                    </div>
                                        <?php if(get_field('video','options')):?>
                                        <div class="embed-responsive embed-responsive-16by9" style="clear: both;">
                                            <?php the_field('video','options'); ?>
                                        </div>
                                        <?php endif; ?>
                                </div>
                        </div>
                </div>
        <?php endif; ?>
    <?php endif; ?>
<?php /*else: echo $_COOKIE['modale'];*/ endif; ?>
               
