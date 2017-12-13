<?php get_header(); ?>
<section id="slider" class="row">
    <div class="col-md-12 carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <?php $slideIMG = 0; if(have_rows('slider','option')) : while (have_rows('slider','option')) : the_row(); ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $slideIMG; ?>" <?php if($slideIMG===0) {?>class="active"<?php } ?>></li>
        <?php $slideIMG++; endwhile; endif; ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php $slideIMG = 0; if(have_rows('slider','option')) : while (have_rows('slider','option')) : the_row(); $image = get_sub_field('image');?>
            <div class="item<?php if($slideIMG===0) {?> active<?php } ?>">
                <?php if(get_sub_field('lien')): ?><a href="<?php the_sub_field('lien'); ?>"><?php endif; ?>
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
                    <?php if(get_sub_field('texte')) : ?>
                    <div class="carousel-caption">
                        <h2><?php the_sub_field('texte'); ?></h2> 
                    </div>
                    <?php endif; ?>
                <?php if(get_sub_field('lien')): ?></a><?php endif; ?>
            </div>
            <?php $slideIMG++; endwhile; endif; ?>
        </div>
    </div>
</section>
<section class="row" id="events">
    <h1 class="col-md-12 text-center"><a href="http://www.ticoet.fr/banquet-celeste/agenda/">Agenda</a></h1>
<?php
    if (class_exists('EM_Events')) {
	$myevts = EM_Events::get( array('limit'=>3) );
        function str_replace_mois(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);   
     };
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
        foreach($myevts as $ev):
            $date = date("d F Y", strftime(strtotime($ev->start_date)));
            $nodate = date("F Y", strftime(strtotime($ev->start_date)));
            //print_r($date);
            $jour = str_replace_mois($replace,$date);
            $nojour =  str_replace_mois($replace,$nodate);
            //print_r($jour);
            $location = new EM_Location($ev->location_id);
            ?>
    <article class="col-md-4">
        <header>
            <?php $programme = $ev->event_attributes[programme_associe]; ?>
            <h1><a href="<?php if($programme):echo get_page_link($programme);else:the_permalink($ev->post_id);endif; ?>"><?php echo $ev->event_name; ?></a></h1>
            <h2><a href="<?php if($programme):echo get_page_link($programme);else:the_permalink($ev->post_id);endif; ?>"><?php //print_r($ev->event_attributes);
            echo $ev->event_attributes[compositeurs]; ?></a></h2>
        </header>
        <figure>
            <a href="<?php if($programme):echo get_page_link($programme);else:the_permalink($ev->post_id);endif; ?>">
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
        </figure>
        <?php //$ev->event_attributes[lien]; `
        //`data-toggle="tooltip" data-placement="top" title="Voir sur le site  echo $location->location_name;" ?>
        <?php /*print_r($ev);*/?>
        <time datetime="<?php echo $ev->start_date.'T'.$ev->event_start_time; ?>"><?php if($ev->event_attributes[lien]):?><a href="<?php the_permalink($ev->post_id); ?>"><?php if($ev->event_attributes[date]==1): echo $nojour;else: echo $jour;endif; ?></a><?php else: echo $jour; endif; ?></time>
        <?php if($ev->event_attributes[date]==1): ?><em><small>(date précisée ultèrieurement)</small></em><?php endif; ?>
        <h3><?php echo $location->location_name; ?></h3>
        <h4><?php echo $location->location_town; ?></h4>
        <aside>
            <?php if($programme): ?>
            <a href="<?php echo get_page_link($programme); ?>" class="btn btn-default">Voir le programme complet</a>
            <?php endif; ?>
            <div><small><?php echo $ev->event_attributes[soutien]; ?></small></div>
        </aside>
        <?php //var_dump($ev->event_attributes); ?>
    </article>  
        <?php endforeach;
    }
?>
</section>
<?php if(get_field('news','option')==1):?>
<section id="news" class="row">
    <h1 class="col-md-12 text-center">Actualités</h1>
    <?php 
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
                                //'post-type' => 'page',
                                  'orderby' => 'date',
                                  'posts_per_page' => 3,
                                  'paged' => $paged
                                );
        $the_query = new WP_Query($args);
        //$the_query = new WP_Query(array('posts_per_page' => 3,));
        while ($the_query->have_posts()) : 
        $the_query->the_post();
    ?>
    <article class="col-md-4">
        <a href="<?php the_permalink(); ?>">
            <header>
                <h1><?php the_title(); ?></h1>
            </header>
            <?php the_post_thumbnail('full'); ?>
        </a>
    </article>
    <?php endwhile; ?>
</section>
<?php endif; ?>
<section id="disque" class="row">
    <h1 class="col-md-12 text-center"><a href="http://www.ticoet.fr/banquet-celeste/medias/discographie/">Discographie</a></h1>
    <?php 
        $disque = new WP_Query( array( 'post_type' => 'disque', 'posts_per_page' => 3) );
        while ($disque->have_posts()) : 
        $disque->the_post();
                //print_r($disque);
    ?>
    <article class="col-md-2">
        <header class="text-center hidden">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h1></a>
        </header>
        <figure class="">
            <a href="<?php the_permalink(); ?>">
                <?php //var_dump(the_post_thumbnail('disque'));?>
                <?php the_post_thumbnail('disque'); ?>
            </a>
        </figure>
        <aside class="hidden">
            <?php if(get_field('video')):?>
            <div class="embed-responsive embed-responsive-16by9">
                <?php the_field('video'); ?>
            </div>
            <?php endif; ?>
            <?php  if(get_field('lien_vers_la_video')):?>
            <div class="well center-block hidden" style="max-width:400px">
                <a class="btn btn-default btn-lg btn-block" href="<?php the_field('lien_vers_la_video'); ?>">Voir la vidéo en ligne</a>
            </div>
            <?php endif; ?>
            <?php if(get_field('link')):?>
            <div class="well center-block" style="max-width:400px">
                <a class="btn btn-default btn-lg btn-block" href="<?php the_field('link'); ?>">Commander le disque - <?php the_field('label'); ?></a>
            </div>
            <?php endif; ?>
            <?php //the_excerpt(); ?>
        </aside>
    </article>
    <?php endwhile; ?>
    <aside class="col-md-6">
        Texte d'informations ou revue de presse
    </aside>
</section>
<section class="row hidden" id="presse">
    <?php 
        $presse = [
            'post_type' => 'presse',
            'posts_per_page' => 1,
            'order' => 'DESC',
            'orderby' => 'date',
        ];
        $lapresse = new WP_Query($presse);
        //print_r($lapresse);
        while ($lapresse->have_posts()) : $lapresse->the_post();?>
    <article class="clearfix">
        <header class="col-md-8">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <?php 
            $evlink = get_field('evenement_lie')[0]->guid;
            $ev = get_field('evenement_lie')[0]->ID;
            $evdate = em_get_event($ev, 'post_id')->event_start_date;
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
            $jour = str_replace_assoc($replace,$dateJ);
            //print_r($dateJ." - ".$jour);
            ?>
            <?php if($evdate):?>
            <h2><a href="<?php echo $evlink; ?>"><time datetime='<?php echo $evdate; ?>'><?php echo $jour; ?></time> - <?php echo em_get_event($ev, 'post_id')->get_location()->name; ?></a></h2>
            <?php endif; ?>
            <?php the_excerpt(); ?>
            <?php /*if(get_field('lien')):
            echo '<a class="btn btn-default pull-right" href="'.get_field('lien').'">';
            if(get_field('source')): echo 'Sur '.get_field('source'); else : echo 'Voir la source'; endif;
            echo '</a>';
            endif;*/ ?>
        </header>
        <picture class="col-md-4">
            <?php if(get_field('video')):?>
            <div class="embed-responsive embed-responsive-16by9">
                <?php the_field('video'); ?>
            </div>
            <?php else:?>
            <?php the_post_thumbnail('full'); ?>
            <?php endif; ?>
        </picture>
        <?php //var_dump($lapresse);
        //print_r(em_events(get_field('evenement_lie')[0]->ID));
        //echo "<hr>";
        //$ev = get_field('evenement_lie')[0]->ID;
        //$eventpresse = apply_filters('em_content_events_args', $ev);
        //$eventpresse['event'] = get_field('evenement_lie')[0]->ID;
        //$eventpresse['post_id'] = get_field('evenement_lie')[0]->ID;
        //var_dump(em_get_event(22444, 'post_id') );
        //print_r($ev);
        ?>
    </article>    
        <?php endwhile; ?>
</section>
<?php get_footer(); ?>
