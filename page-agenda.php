<?php

/*
Template Name: Agenda
*/

get_header(); ?>
<div class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
    <!--<nav class="col-md-12 text-center">dates antérieurs</nav>-->
</div>
<aside class="row">
    <div class="col-sm-6 col-sm-offset-3">
<?php echo EM_Calendar::output(array('full' => 0, 'long_events' => 1)); ?>
    </div>
</aside>
<div id="i-scroll">
<?php 
    $args = array('scope'=>'future', 'limit'=>4, 'pagination'=>1, 'page' => ($_GET['events']) ? $_GET['events'] : 1, 'offset'=> 0, 'page_queryvar'=>'events');
    $count = EM_Events::count( $args );
    $evs = EM_Events::get($args);
    //print_r($evs);
    function str_replace_mois(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);   
     };
    foreach($evs as $ev)://print_r($ev->event_all_day);
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
            'Decembre' => 'décembre',
        );
        $date = date("F Y", strftime(strtotime($ev->event_start_date)));
        $dateNum = date("d", strftime(strtotime($ev->event_start_date)));
        $jour = str_replace_mois($replace,$date);
        if($ev->event_all_day==0):
        $evheure = $ev->event_start_time;//print_r($evheure);
        $dateH = date("H\hi", strftime(strtotime($evheure)));
        $lheure=" à ".$dateH;
        else:
        $lheure="";    
        endif;
        $location = new EM_Location($ev->location_id);
        $programme = $ev->event_attributes[programme_associe];
        $lat = $location->location_latitude; //print_r($lat);
        $lng = $location->location_longitude;
        if($programme):
            $lien = get_post_permalink($programme);
        else:
            $lien = get_the_permalink($ev->post_id);
        endif;
        ?>
    <article class="row">
        <header class="col-sm-4 col-sm-push-4 col-md-6 col-md-push-3">
            <h1><a href="<?php echo $lien;//the_permalink($ev->post_id); ?>"><?php echo $ev->event_name; ?></a></h1>
            <h2><?php $array =is_array($ev->event_attributes[compositeurs]);if($array == 1):echo $ev->event_attributes[compositeurs][0];else:
                echo $ev->event_attributes[compositeurs];endif; ?><?php //echo $ev->event_attributes[compositeurs]; ?></h2>
            <?php if($programme): ?><?php     //print_r($ev->attributes); ?>
                <a href="<?php echo get_post_permalink($programme); ?>" class="btn btn-default hidden"><i class="fa fa-file-text-o" aria-hidden="true"></i>
     Voir le programme complet</a>
            <?php endif; ?>
        </header>
        <main class="col-sm-4 col-sm-pull-4 col-md-3 col-md-pull-6">
            <time><?php if($ev->event_attributes[date]): echo $jour; else: echo "<span>".$dateNum."</span> ".$jour.$lheure; endif; ?></time>
            <?php if($ev->event_attributes[date]): ?><em><small>(date précisée ultèrieurement)</small></em><?php endif; ?>
            <address><?php echo $location->location_name; ?><br><i class="fa fa-location-arrow" aria-hidden="true"></i> <a href="http://maps.google.com/maps?q=<?php echo $lat.','.$lng;?>"><?php echo $location->location_town; ?></a>
     </address>
        </main>
        <aside class="col-sm-4 col-md-3">
            <?php //$lelien="";if(get_post_permalink($programme)):$lelien = get_post_permalink($programme);else: $lelien = get_permalink($ev->post_id);endif;//print_r($lelien);?>
            <a href="<?php echo $lien;//the_permalink($ev->post_id); ?>">
            <?php 
                //$image = $ev->event_attributes[image_accueil];
                $imageID = get_post_thumbnail_id($ev->post_id);
                $programme = $ev->event_attributes[programme_associe];
    //            if($image){
    //                echo wp_get_attachment_image( $image, 'full' );
    //            }
    //            else{
                    echo wp_get_attachment_image($imageID,"home_oeuvres");
    //            } 
                ?>
            </a>
        </aside>
    </article>
    <?php endforeach;
?>
<img class="loader" style="display: none;" src="<?php echo get_template_directory_uri(); ?>/img/loader.gif" />
</div>
<?php 
//echo EM_Events::get_pagination_links( $args, $count );
//echo EM_Events::output($args);
//echo do_shortcode('[events_list scope="future" limit=4 pagination=1 page=1]');
//print_r(isset($_GET['events']) ? $_GET['events'] : 0);
?>
<?php get_footer(); ?>
<script type="text/javascript" src="http://banquet-celeste.fr/wp-content/themes/BanquetCeleste/js/monjs.js?ver=4.8">