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
    <h1><?php the_title(); ?><?php //if($EM_Event->event_attributes[asterisque] == 1): echo ' *';endif; ?></h1>

<?php if(get_field('compositeurs')):?>
<h2><?php the_field('compositeurs'); ?></h2>
<h3><?php echo $EM_Event->location->location_name; ?></h3>

    <time datetime='<?php echo $evdate.'T'.$evheure; ?>'><?php if($EM_Event->event_attributes[date]==1): echo $nojour; else : echo $jour." à ".$dateH; endif; ?></time>
    <?php if($EM_Event->event_attributes[date]==1): ?><em><small>(date précisée ultèrieurement)</small></em><?php endif; ?>
<?php endif; ?>
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
    <?php //$location = new EM_Location($EM_Event->location_id);
        //print_r($location);echo "<hr>";
        $plus = $EM_Event->location->location_attributes; ?>
    
    <?php if($programme): ?>
    <?php //echo wpautop($EM_Event->post_content); ?>
    <!--<h3 class="border">Présentation</h3>-->
    <?php $prog = new WP_Query(['post_type' => 'programme', 'page_id' => $programme]);
    if($prog->have_posts()):while($prog->have_posts()):$prog->the_post();?>
    <?php //the_field('description'); ?>
    <?php if($EM_Event->post_content):
    echo wpautop($EM_Event->post_content);
    else:
    the_excerpt();
    endif;
    if(get_field('video')):?>
    <div class="embed-responsive embed-responsive-16by9">
        <?php echo get_field('video'); ?>
    </div>
    <?php endif;?>
    <?php endwhile;endif; ?><?php //print_r($plus); ?>
    <address class="col-sm-6"><a href="http://maps.google.com/maps?q=<?php echo $lat.','.$lng;?>" class="address"><?php if($plus[lieu]):echo $plus[lieu]; ?><br><?php endif;echo $EM_Event->location->location_address; ?><br><?php echo $EM_Event->location->location_postcode." ".$evville; ?></a>
        <?php if($plus[telephone]):?>
        <a href="tel:<?php echo preg_replace('/\s/', '', $plus[telephone]); ?>" class="telephone"><?php echo $plus[telephone]; ?></a>
        <?php endif; ?>
        <?php if($plus[mail]):?>
        <a href="mailto:<?php echo $plus[mail]; ?>" class="mail"><?php echo $plus[mail]; ?></a>
        <?php endif; ?>
    <?php if($EM_Event->event_attributes[lien]):?>
    <a class="btn btn-default" href="<?php echo $EM_Event->event_attributes[lien]; ?>"><i class="fa fa-external-link" aria-hidden="true"></i>
 Site de l’organisateur</a>
    <?php endif; ?>
    </address>
    <aside class="col-sm-6">
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
    <?php if($programme):?>   
    <?php     //print_r($programme.' - '.get_post_permalink($programme)); ?>
            <a href="<?php echo get_post_permalink($programme); ?>" class="btn btn-default"><i class="fa fa-file-text-o" aria-hidden="true"></i>
 En savoir +</a>
            <?php endif; ?>
    </aside>
    <?php else:
        echo wpautop($EM_Event->post_content);
    //print_r($EM_Event->attributes);
    if($EM_Event->attributes[video]):?>
    <div class="embed-responsive embed-responsive-16by9">
        <?php echo $EM_Event->attributes[video]; ?>
    </div>
    <?php endif;?>
    <?php if( $EM_Event->attributes[audio] ):?>
        <div id="audio">
            <h4 class="hidden"><i class="fa fa-music" aria-hidden="true"></i> Extrait(s) sonore(s)</h4>
            <?php while ( have_rows('audio') ) : the_row();

               if( get_row_layout() == 'fichier' ):?>

                       <?php echo do_shortcode('[audio src="'.get_sub_field('son').'"]');?>

               <?php elseif( get_row_layout() == 'url' ):?>

                       <?php echo do_shortcode('[audio src="'.get_sub_field('audio').'"]');?>

               <?php endif;

           endwhile;?>
        </div>
       <?php endif; ?><?php //print_r($EM_Event); ?>
    <address class="col-sm-6"><a href="http://maps.google.com/maps?q=<?php echo $lat.','.$lng;?>" class="address"><?php if($plus[lieu]):echo $plus[lieu]; ?><br><?php endif;echo $EM_Event->location->location_address; ?><br><?php echo $EM_Event->location->location_postcode." ".$evville; ?></a>
        <?php if($plus[telephone]):?>
        <a href="tel:<?php echo preg_replace('/\s/', '', $plus[telephone]); ?>" class="telephone"><?php echo $plus[telephone]; ?></a>
        <?php endif; ?>
        <?php if($plus[mail]):?>
        <a href="mailto:<?php echo $plus[mail]; ?>" class="mail"><?php echo $plus[mail]; ?></a>
        <?php endif; ?>
    <?php if($EM_Event->event_attributes[lien]):?>
    <a class="btn btn-default" href="<?php echo $EM_Event->event_attributes[lien]; ?>"><i class="fa fa-external-link" aria-hidden="true"></i>
 Site de l’organisateur</a>
    <?php endif; ?>
    </address>
    <aside class="col-sm-6">
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
    </aside>
    <?php endif; ?>
    <?php //print($EM_Event->event_attributes[carte]);?>
    <?php if($EM_Event->event_attributes[carte] == 1):?>
    <map class="col-sm-12 col-md-12 text-center" id="map">
        <?php if($plus[lieu]): ?>
        <style>
            .single-event .em-map-balloon-content strong:after{
                content: "<?php echo $plus[lieu]; ?>";
                display: block;
                font-style: italic;
                margin-bottom: -15px;
            }
        </style>
        <?php endif; ?>
        <?php //echo do_shortcode('[locations_map town="'.$evville.'" country="'.$evpays.'"]'); 
    //location_id="'.$evlocation.'"
        echo $EM_Event->output('#_LOCATIONMAP');
        //the_post_thumbnail('full'); ?>
    </map> 
    <?php endif;?>
</main>
</article>
<?php //get_template_part('widget'); ?>
<?php get_footer(); ?>