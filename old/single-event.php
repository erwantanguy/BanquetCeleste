<?php get_header(); ?>
<article class="row">
<?php 
$evdate = $EM_Event->event_start_date;
$evdate2 = $EM_Event->event_end_date;
$evheure = $EM_Event->event_start_time; //print_r($evheure);
 //print_r($evheure);
$evheure2 = $EM_Event->event_end_time;
$lat = $EM_Event->location->location_latitude; //print_r($lat);
$lng = $EM_Event->location->location_longitude; //print_r($lng);
$evlocation = $EM_Event->location->location_id;
$evville = $EM_Event->location->town;
$evpays = $EM_Event->location->country;
$programme = $EM_Event->event_attributes[programme_associe];
$replace = array(
    'January' => 'janvier',
    'February' => 'février',
    'March' => 'mars',
    'April' => 'avril',
    'May' => 'mai',
    'June' => 'juin',
    'July' => 'juillet',
    'August' => 'août',
    'September' => 'septembre',
    'October' => 'octobre',
    'November' => 'novembre',
    'December' => 'décembre',
);
$dateJ = date("d F Y", strftime(strtotime($evdate)));
$nodate = date("F Y", strftime(strtotime($evdate)));
//print_r($dateJ);
$datej = date("d/m/Y", strftime(strtotime($evdate)));
//print_r($datej);
$datejj = date("m/d/Y", strftime(strtotime($evdate)));
$datejj2 = date("m/d/Y", strftime(strtotime($evdate2)));
//print_r($datejj);
$dateH = date("H\hi", strftime(strtotime($evheure)));
$dateh = date("h:i A", strftime(strtotime($evheure)));
//print_r($dateH);
$dateh2 = date("h:i A", strftime(strtotime($evheure2)));
//print_r($dateh);
$jour = str_replace_assoc($replace,$dateJ);
$nojour = str_replace_assoc($replace,$nodate);
?>
<h1><?php the_title(); ?></h1>
<time datetime='<?php echo $evdate.'T'.$evheure; ?>'><?php if($EM_Event->event_attributes[date]==1): echo $nojour; else: echo $jour." à ".$dateH; endif; ?></time>
<map class="col-sm-12 col-md-12 text-center" id="map">
    <?php //echo do_shortcode('[locations_map town="'.$evville.'" country="'.$evpays.'"]'); 
//location_id="'.$evlocation.'"
    //echo $EM_Event->output('#_LOCATIONMAP');
    //the_post_thumbnail('full'); ?>
</map>
<?php
if ( function_exists('yoast_breadcrumb') ) {?>
<nav class="col-sm-12 col-md-12" id="breadcrumbs"><?php if($EM_Event->event_attributes[date]==1):yoast_breadcrumb('<p class="breadcrumb">',' <small>- en '.$nojour.'</small>
</p>'); else:yoast_breadcrumb('<p class="breadcrumb">',' <small>- le '.$jour.' à '.$dateH.'</small>
</p>'); endif;?>
    <aside>
        <?php $prev_post = get_previous_post();//get_adjacent_post( true, '', true, 'taxonomy_slug' );    print_r(get_previous_post()); ?>
        <?php if ( is_a( $prev_post, 'WP_Post' ) ) { ?>
               <a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo get_the_title( $prev_post->ID ); ?>"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i>
</a>
        <?php } ?>
               <a href="#" title="Agenda"><i class="fa fa-calendar" aria-hidden="true"></i></a>
           <?php $next_post = get_next_post();//get_adjacent_post( true, '', false, 'taxonomy_slug' );  print_r(get_next_post()); ?>
        <?php if ( is_a( $next_post, 'WP_Post' ) ) {  ?>
               <a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo get_the_title( $next_post->ID ); ?>"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
</a>
        <?php } ?>
    </aside>
</nav>
<?php }?>
<?php //echo $EM_Event->output_single(); ?>
<main class="col-md-8 col-md-offset-2">
    <h2><?php echo $EM_Event->location->location_name; ?></h2>
    <?php //$location = new EM_Location($EM_Event->location_id);
        //print_r($location);echo "<hr>";
        $plus = $EM_Event->location->location_attributes; ?>
    <address><a href="http://maps.google.com/maps?q=<?php echo $lat.','.$lng;?>" class="address"><?php echo $EM_Event->location->location_address; ?><br><?php echo $EM_Event->location->location_postcode." ".$evville; ?></a>
        <?php if($plus[telephone]):?>
        <a href="tel:<?php echo preg_replace('/\s/', '', $plus[telephone]); ?>" class="telephone"><?php echo $plus[telephone]; ?></a>
        <?php endif; ?>
        <?php if($plus[mail]):?>
        <a href="mailto:<?php echo $plus[mail]; ?>" class="mail"><?php echo $plus[mail]; ?></a>
        <?php endif; ?>
    </address>
    <time datetime='<?php echo $evdate.'T'.$evheure; ?>'><i class="fa fa-calendar" aria-hidden="true"></i>
 <?php if($EM_Event->event_attributes[date]==1): echo $nojour; else : echo $jour." à ".$dateH; endif; ?></time>
    <?php if($EM_Event->event_attributes[date]==1): ?><em><small>(date précisée ultèrieurement)</small></em><?php endif; ?>
    <?php if($EM_Event->event_attributes[lien]):?>
    <a class="btn btn-default" href="<?php echo $EM_Event->event_attributes[lien]; ?>"><i class="fa fa-external-link" aria-hidden="true"></i>
 Site de l’organisateur.</a>
    <?php endif; ?>
    <script type="text/javascript" src="https://addthisevent.com/libs/1.6.0/ate.min.js"></script>
    <div title="Add to Calendar" class="btn btn-default addthisevent">
        <span class="fa fa-calendar-plus-o"></span>
        Ajouter à votre agenda
        <span class="start"><?php echo $datejj." ".$dateh; ?></span>
        <span class="end"><?php echo $datejj2." ".$dateh2; ?></span>
        <span class="timezone">Europe/Paris</span>
        <span class="title"><?php the_title(); ?></span>
        <span class="description"><?php the_excerpt(); ?><br><br><?php echo $EM_Event->location->location_name."<br>".$EM_Event->location->location_address."<br>".$EM_Event->location->location_postcode." ".$evville;//." ".$evpays; ?></span>
        <span class="location"><?php echo $EM_Event->location->location_name." ".$EM_Event->location->location_address." ".$EM_Event->location->location_postcode." ".$evville;//." ".$evpays; ?></span>
        <span class="all_day_event">false</span>
        <span class="date_format"><?php echo $datejj; ?></span>
    </div>
    <?php if($programme): ?>
    <?php     //print_r($programme.' - '.get_post_permalink($programme)); ?>
            <a href="<?php echo get_post_permalink($programme); ?>" class="btn btn-default"><i class="fa fa-file-text-o" aria-hidden="true"></i>
 Voir le programme complet</a>
            <?php endif; ?>
    <!--<h3 class="border">Présentation</h3>-->
    <?php if($EM_Event->event_attributes[audio_0_son] || $EM_Event->event_attributes[audio_0_audio] || $EM_Event->event_attributes[video]):?>
    <?php if($EM_Event->event_attributes[audio_0_son]):?>
    <h4 class="border"><i class="fa fa-music" aria-hidden="true"></i>
 Extrait(s) sonore(s)</h4>
    <div class="row col-md-10">
    <?php $son = wp_get_attachment_url( $EM_Event->event_attributes[audio_0_son] ); ?>
    <?php echo do_shortcode('[audio src="'.$son.'"]');?></div>
    <?php elseif($EM_Event->event_attributes[audio_0_audio]):?>
    <h4 class="border"><i class="fa fa-music" aria-hidden="true"></i> Extrait(s) sonore(s)</h4>
    <div id="audio">
    <?php echo do_shortcode('[audio src="'.$EM_Event->event_attributes[audio_0_audio].'"]');?></div>
    <?php ;endif; ?>
    <?php if($EM_Event->event_attributes[video]):?>
    <h4 class="border hidden"><i class="fa fa-video-camera" aria-hidden="true"></i>
 Extrait(s) vidéo</h4>
    <?php //echo wpautop($EM_Event->post_content);
    $prog = new WP_Query(['post_type' => 'programme', 'page_id' => $programme]);
    if($prog->have_posts()):while($prog->have_posts()):$prog->the_post();
    if(get_the_field('video')):?>
    <div class="embed-responsive embed-responsive-16by9">
        <?php the_field('video'); ?>
    </div>
    <?php endif;endwhile;endif;?>
    <?php endif;else:?>
    <picture class="border">
        <?php the_post_thumbnail('full'); ?>
    </picture>
    <?php endif; ?>
</main>
</article>
<aside class="row" id="widget">
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
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_4') ) : ?><?php endif; ?>
    </div>
</aside>
<script>
/*var isDraggable = !('ontouchstart' in document.documentElement);
var mapOptions = {
  draggable: isDraggable,
  scrollwheel: false
};*/
</script>
<?php get_footer(); ?>