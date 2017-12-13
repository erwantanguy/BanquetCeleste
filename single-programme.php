<?php get_header(); ?>
<section class="row" id="thumbnail">
    <div class="col-md-12">
         <?php the_post_thumbnail('full'); ?>
    </div>
</section>
<section class="row" id="content">
    <h1 class="col-sm-12 col-md-12"><?php the_title(); ?></h1>
    <h2 class="col-sm-12 col-md-12"><?php the_field('musiciens'); ?></h2>
    <?php if(get_the_terms($post->ID, 'cat')): ?>
    <?php $cat = get_the_terms($post->ID, 'cat')[0]->name;//print_r(get_the_terms($post->ID, 'cat')[0]->name);?>
    <h3 class="categorie"><?php echo $cat; ?></h3>
    <?php endif; ?>
    <nav class="col-sm-12 col-md-12" id="breadcrumbs"><?php yoast_breadcrumb('<p class="breadcrumb">','</p>');?>
    </nav>
    <div class="col-md-12" id="description">
         <?php the_field('description'); ?>
    </div>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <main class="col-sm-6 col-md-6">
        <?php the_content(); ?>
    </main>
    <?php endwhile; endif; ?>
    <aside class="col-sm-6 col-md-6">
        <?php $disque = get_field('disque')[0]; ?>
        <?php
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
        function str_replace_mois(array $replace, $subject) {
            return str_replace(array_keys($replace), array_values($replace), $subject);   
         };
        $idP = intval( get_the_id() );
        $today = getdate ();
        $today = date("Y-m-d", $today[0]);
        $myevtsWP = new WP_Query(
                array(
                  'post_type'=>'event',
		  'posts_per_page'=>-1,
                  //'orderby' => 'meta_value',
                  'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'programme_associe',
                            'value' => $idP,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => '_event_start_date' ,
                            'value' => $today,
                            'compare' => '>=' ,
                            'type' => 'date'
                        ),
                    ),
                )
        );
        $myevtsWP2 = new WP_Query(
                array(
                  'post_type'=>'event',
		  'posts_per_page'=>-1,
                  //'orderby' => 'meta_value',
                  'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'programme_associe',
                            'value' => $idP,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => '_event_start_date' ,
                            'value' => $today,
                            'compare' => '<' ,
                            'type' => 'date'
                        ),
                    ),
                )
        );
        //echo '<pre>';print_r($myevtsWP);echo '</pre>';//.'<hr>'.$myevtsWP2
        ?>
        <?php //print_r($myevtsWP); ?>
       <?php if($myevtsWP->have_posts()) : ?>
        <h3>Dates</h3>
        <ul id="dates">
        <?php while ($myevtsWP->have_posts() ) : $myevtsWP->the_post();
            $dateS = get_post_meta($id, '_event_start_date', true);
            $dateH = get_post_meta($id, '_event_start_time', true);
            $dateJ = date("d F Y", strftime(strtotime($dateS)));
            $nodate = date("F Y", strftime(strtotime($dateS)));
            $dateh = date("H\hi", strtotime($dateH));
            $jour = str_replace_assoc($replace,$dateJ);
            $nojour = str_replace_assoc($replace,$nodate);
            $heure = str_replace_assoc($replace,$dateh); 
            $id_loc = get_post_meta($id, '_location_id', true);$location = new EM_Location($id_loc);
            if(get_field('lien')): $lelien = get_field('lien');else: $lelien = get_the_permalink();endif;
            ?>
            <?php //echo '<p>Le <time datetime="'.get_post_meta($id, '_event_start_date', true).' '..'">'.$jour.' à '.$heure.'</time></p>';?>
            <li><a href="<?php echo $lelien; ?>"><time datetime="<?php echo get_post_meta($id, '_event_start_date', true).' '.get_post_meta($id, '_event_start_time', true); ?>"><?php if(get_field('date')==1):echo $nojour; else: echo $jour; endif; ?></time> <?php echo $location->location_name; ?>, <?php echo $location->location_town; ?></a><?php if(get_field('asterisque')): echo ' *'; endif; ?></li>
        <?php endwhile;?>
        </ul>
        <ul id="dates_old">
        <?php while ($myevtsWP2->have_posts() ) : $myevtsWP2->the_post();
            $dateS = get_post_meta($id, '_event_start_date', true);
            $dateH = get_post_meta($id, '_event_start_time', true);
            $dateJ = date("d F Y", strftime(strtotime($dateS)));
            $nodate = date("F Y", strftime(strtotime($dateS)));
            $dateh = date("H\hi", strtotime($dateH));
            $jour = str_replace_assoc($replace,$dateJ);
            $nojour = str_replace_assoc($replace,$nodate);
            $heure = str_replace_assoc($replace,$dateh); 
            $id_loc = get_post_meta($id, '_location_id', true);$location = new EM_Location($id_loc);
            if(get_field('lien')): $lelien = get_field('lien');else: $lelien = get_the_permalink();endif;
            ?>
            <?php //echo '<p>Le <time datetime="'.get_post_meta($id, '_event_start_date', true).' '..'">'.$jour.' à '.$heure.'</time></p>';?>
            <li><a href="<?php echo $lelien; ?>"><time datetime="<?php echo get_post_meta($id, '_event_start_date', true).' '.get_post_meta($id, '_event_start_time', true); ?>"><?php if(get_field('date')==1):echo $nojour; else: echo $jour; endif; ?></time> <?php echo $location->location_name; ?>, <?php echo $location->location_town; ?></a></li>
        <?php endwhile; ?>
        </ul>
        <?php elseif($myevtsWP2->have_posts()): ?>
        <h3>Dates</h3>
        <ul id="dates_old">
        <?php while ($myevtsWP2->have_posts() ) : $myevtsWP2->the_post();
            $dateS = get_post_meta($id, '_event_start_date', true);
            $dateH = get_post_meta($id, '_event_start_time', true);
            $dateJ = date("d F Y", strftime(strtotime($dateS)));
            $nodate = date("F Y", strftime(strtotime($dateS)));
            $dateh = date("H\hi", strtotime($dateH));
            $jour = str_replace_assoc($replace,$dateJ);
            $nojour = str_replace_assoc($replace,$nodate);
            $heure = str_replace_assoc($replace,$dateh); 
            $id_loc = get_post_meta($id, '_location_id', true);$location = new EM_Location($id_loc);
            if(get_field('lien')): $lelien = get_field('lien');else: $lelien = get_the_permalink();endif;
            ?>
            <?php //echo '<p>Le <time datetime="'.get_post_meta($id, '_event_start_date', true).' '..'">'.$jour.' à '.$heure.'</time></p>';?>
            <li><a href="<?php echo $lelien; ?>"><time datetime="<?php echo get_post_meta($id, '_event_start_date', true).' '.get_post_meta($id, '_event_start_time', true); ?>"><?php if(get_field('date')==1):echo $nojour; else: echo $jour; endif; ?></time> <?php echo $location->location_name; ?>, <?php echo $location->location_town; ?></a></li>
        <?php endwhile;?>
        </ul>
        <?php endif;?>
        <?php if($disque): ?>
        <h3>Découvrez le disque</h3>
        <!--<h4><?php echo $disque->post_title; ?></h4>-->
        <a href="<?php echo $disque->guid; ?>" title="<?php echo $disque->post_title; ?>"><?php echo get_the_post_thumbnail( $disque->ID, 'thumbnail' ); ?></a>
        <?php //print_r(get_field('disque')); //[0]->ID?>
        <?php endif; ?>
        <?php if (have_posts()) : while (have_posts()) : the_post();
        if(get_field('video')):?>
            <div class="embed-responsive embed-responsive-16by9">
                <?php the_field('video'); ?>
            </div>
        <?php endif;
        //print_r(get_field('vignettes'));
        if(get_field('vignettes')):?>
        <div class="vignettes"><?php the_field('vignettes'); ?></div>
        <?php endif;
        
        endwhile;endif; ?>
    </aside>
</section>
<?php $presse = new WP_Query(
        array(
            'post_type'=>'presse',
            'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'programme_associe',
                            'value' => $idP,
                            'compare' => 'IN'
                        ),
                    ),
        ));
//print_r($presse);
//print_r($idP);
if ( $presse->have_posts() ) :
	echo '<section id="presse"  class="row">
<h1 class="textcenter">Presse</h1>';
	while ( $presse->have_posts() ) {
		$presse->the_post();?>
<article class="clearfix">
	<header class="col-sm-8 col-md-8"><?php the_content();?><?php if(get_field('lien')): ?>
            <a class="" href="<?php the_field('lien'); ?>"><?php if(get_field('source')): ?><?php the_field('source'); else :?>Voir la source<?php endif;//btn btn-default  ?></a>
            <?php endif; ?></header>
        <aside class="col-sm-4 col-md-offset-1 col-md-3">
            <?php if(get_field('video')):?>
            <div class="embed-responsive embed-responsive-16by9">
                <?php the_field('video'); ?>
            </div>
            <?php else:?>
            <?php if(get_field('lien')){echo '<a href="'.get_field('lien').'" title="'.get_field('source').'">';}?><?php the_post_thumbnail('full');?><?php if(get_field('lien')){echo '</a>';}?>
            <?php endif; ?>
        </aside>
</article>
	<?php }
	echo '</section>';
	/* Restore original Post Data */
	wp_reset_postdata();
        endif;
?>
<?php //get_template_part('widget'); ?>
<?php get_footer(); ?>