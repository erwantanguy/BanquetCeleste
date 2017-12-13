<?php get_header(); ?>
<section id="slider" class="row">
    <div class="col-md-12 carousel slide" data-ride="carousel">
        <?php 
        $actus = new WP_Query(array( 
            'post_type' => 'post',
            'meta_query' => array(
                    array(
                            'key' => 'accueil',
                            'compare' => '==',
                            'value' => '1'
                    )
            )
            ));
            //print_r($actus->have_posts());
         ?>
        <div class="carousel-inner" role="listbox">
            <?php $slideIMG = 0; 
            if($actus->have_posts()):while($actus->have_posts()):$actus->the_post();?>
            <div class="item<?php if($slideIMG===0) {?> active<?php } ?>">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('slider'); ?>
                    <?php if(get_the_title()) : ?>
                    <div class="carousel-caption">
                        <h2><?php the_title(); ?></h2> 
                    </div>
                    <?php endif; ?>
                </a>
            </div>
            <?php $slideIMG++;endwhile;endif;
            if(have_rows('slider','option')) : while (have_rows('slider','option')) : the_row(); $image = get_sub_field('image');if(get_sub_field('accueil','option')==1):
  //print_r($image[sizes][slider]);?>
            <div class="item<?php if($slideIMG===0) {?> active<?php } ?>">
                <?php if(get_sub_field('lien')): ?><a href="<?php the_sub_field('lien'); ?>"><?php endif; ?>
                    <img src="<?php echo $image[sizes][slider]; ?>" alt="<?php echo $image['alt'] ?>" />
                    <?php if(get_sub_field('texte')) : ?>
                    <div class="carousel-caption">
                        <h2><?php the_sub_field('texte'); ?></h2> 
                    </div>
                    <?php endif; ?>
                <?php if(get_sub_field('lien')): ?></a><?php endif; ?>
            </div>
            <?php $slideIMG++;endif; endwhile; endif; ?>
        </div>
        <?php $count = $actus->post_count;if($count+$slideIMG > 1): ?>
        <a class="left carousel-control" href="#slider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#slider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <?php endif; ?>
    </div>
</section>
<section class="row" id="events">
    <h1 class="col-md-12 text-center"><a href="http://banquet-celeste.fr/agenda/">Agenda</a></h1>
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
            <?php $programme = $ev->event_attributes[programme_associe];//print_r(get_post_permalink($programme)); ?>
            <h1><a href="<?php if($programme):echo get_post_permalink($programme);else:the_permalink($ev->post_id);endif; ?>"><?php echo $ev->event_name; ?></a></h1>
            <h2><?php $array =is_array($ev->event_attributes[compositeurs]);if($array == 1):echo $ev->event_attributes[compositeurs][0];else:
            echo $ev->event_attributes[compositeurs];endif; ?></h2>
        </header>
        <figure><?php //print_r(get_post_thumbnail_id($ev->post_id)); ?>
            <a href="<?php if($programme):echo get_post_permalink($programme);else:the_permalink($ev->post_id);endif; ?>">
            <?php $imageID = get_post_thumbnail_id($ev->post_id);
            /*if($ev->event_attributes[image_accueil][0]):$image = $ev->event_attributes[image_accueil];else:
            $image = $ev->event_attributes[image_accueil];endif;print_r($image);
            
            if($image){
                echo wp_get_attachment_image( $image, 'full' );echo 'test';
            }
            else{*/
                echo wp_get_attachment_image($imageID,"home_oeuvres");//print_r(wp_get_attachment_image($imageID,"home_oeuvres"));echo 'test';
            //} 
            ?>
            </a>
        </figure>
        <?php //$ev->event_attributes[lien]; `
        //`data-toggle="tooltip" data-placement="top" title="Voir sur le site  echo $location->location_name;" ?>
        <?php /*print_r($ev);*/?>
        <!-- <a href="<?php the_permalink($ev->post_id); ?>"> </a> -->
        <?php if($ev->event_attributes[lien]): $lienDeb = '<a href="'.$ev->event_attributes[lien].'">'; $lienFin = '</a>';else:$lienDeb = '';$lienFin = '';endif; ?>
        <time datetime="<?php echo $ev->start_date.'T'.$ev->event_start_time; ?>"><?php if($ev->event_attributes[lien]):?><?php echo $lienDeb;if($ev->event_attributes[date]==1): echo $nojour;else: echo $jour;endif;echo $lienFin; ?><?php else: echo $jour; endif; ?></time>
        <?php if($ev->event_attributes[date]==1): ?><em><small>(date précisée ultèrieurement)</small></em><?php endif; ?>
        <h3><?php echo $location->location_name; ?></h3>
        <h4><?php echo $location->location_town; ?></h4>
        <?php //var_dump($ev->event_attributes[lien]); ?>
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
        <header class="col-md-12 text-center">
            <?php if(get_field('liendisco','options')):?>
            <h1><a href="<?php the_field('liendisco','options'); ?>"><?php the_field('titredisco','options'); ?></a></h1>
            <?php else: ?>
            <h1><?php the_field('titredisco','options'); ?></h1>
            <?php endif; ?>
            <?php //the_field('textedisco', 'options'); ?>
        </header>
    <?php 
        $disque = new WP_Query( array( 'post_type' => 'disque', 'posts_per_page' => 2) );?>
        <?php //echo '<pre>';print_r($disque->post);echo '</pre>'; ?>
        <?php while ($disque->have_posts()) : 
        $disque->the_post();
                //print_r($disque);
    ?>
    <article class="col-sm-6">
        <figure class="col-sm-6" rel="<?php the_title(); ?>">
            <a href="<?php the_permalink(); ?>">
                <?php //var_dump(the_post_thumbnail('disque'));?>
                <?php the_post_thumbnail('disque'); ?>
            </a>
        </figure>
        <header class="col-sm-6">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <?php echo wpautop(get_the_excerpt()); ?>
            <a href="<?php the_permalink(); ?>" class="linkplus">En savoir +</a>
        </header>
    </article>
    <?php endwhile; ?>
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
