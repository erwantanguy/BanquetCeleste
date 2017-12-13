<?php

/*
Template Name: Agenda old
*/




get_header(); ?>
<div class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
    <nav class="col-md-12 text-center">retour à l'agenda</nav>
</div>
<?php 
    $evs = EM_Events::get(array('scope'=>'past', 'order' => 'DESC', 'pagination'=> 1));
    //print_r($evs);
    function str_replace_mois(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);   
     };
    foreach($evs as $ev):
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
        $evheure = $ev->event_start_time;
        $dateH = date("H\hi", strftime(strtotime($evheure)));
        $location = new EM_Location($ev->location_id);
        $programme = $ev->event_attributes[programme_associe];
        $lat = $location->location_latitude; //print_r($lat);
        $lng = $location->location_longitude;
        ?>
<article class="row">
    <header class="col-md-6 col-md-push-3">
        <h1><a href="<?php the_permalink($ev->post_id); ?>"><?php echo $ev->event_name; ?></a></h1>
        <h2><?php echo $ev->event_attributes[compositeurs]; ?></h2>
        <?php if($programme): ?>
            <a href="<?php echo get_post_permalink($programme); ?>" class="btn btn-default"><i class="fa fa-file-text-o" aria-hidden="true"></i>
 Voir le programme complet</a>
        <?php endif; ?>
    </header>
    <main class="col-md-3 col-md-pull-6">
        <time><?php if($ev->event_attributes[date]): echo $jour; else: echo "<span>".$dateNum."</span> ".$jour." à ".$dateH; endif; ?></time>
        <?php if($ev->event_attributes[date]): ?><em><small>(date précisée ultèrieurement)</small></em><?php endif; ?>
        <address><?php echo $location->location_name; ?><br><i class="fa fa-location-arrow" aria-hidden="true"></i> <a href="http://maps.google.com/maps?q=<?php echo $lat.','.$lng;?>"><?php echo $location->location_town; ?></a>
 </address>
    </main>
    <aside class="col-md-3">
        <a href="<?php the_permalink($ev->post_id); ?>">
        <?php 
            $image = $ev->event_attributes[image_accueil];
            $imageID = get_post_thumbnail_id($ev->post_id);
            $programme = $ev->event_attributes[programme_associe];
            if($image){
                echo wp_get_attachment_image( $image, 'full' );
            }
            else{
                echo wp_get_attachment_image($imageID,"home_oeuvres");
            } 
            ?>
        </a>
    </aside>
</article>
    <?php endforeach;
?>
<?php //print_r($evs); ?>
<?php get_footer(); ?>