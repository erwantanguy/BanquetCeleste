<?php get_header(); ?>
<section class="row">
<h1 class="col-sm-12 col-md-12"><?php the_title(); ?></h1>
<h2 class="col-sm-12 col-md-12"><?php the_field('sous-titre'); ?></h2>
<nav class="col-sm-12 col-md-12" id="breadcrumbs"><?php yoast_breadcrumb('<p class="breadcrumb">','</p>');?>
</nav>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <figure class="col-md-3">
        <?php the_post_thumbnail('full'); ?>
        <?php if(get_field('disque')[0]): ?>
        <h3>Découvrez le disque</h3>
        <!--<h4><?php echo get_field('disque')[0]->post_title; ?></h4>-->
        <a href="<?php echo get_field('disque')[0]->guid; ?>" title="<?php echo get_field('disque')[0]->post_title; ?>"><?php echo get_the_post_thumbnail( get_field('disque')[0]->ID, 'full' ); ?></a>
        <?php //print_r(get_field('disque')); //[0]->ID?>
        <?php endif; 
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
        ?>
        <?php if (class_exists('EM_Events')) :
        $idP = intval( get_the_id() );
        $today = getdate ();
        $today = date("Y-m-d", $today[0]);
        $myevtsWP = new WP_Query(
                array(
                  'post_type'=>'event',
		  'posts_per_page'=>-1,
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
        if($myevtsWP->have_posts()) : ?>
        <h3>Dates</h3>
        <ul id="dates">
        <?php while ($myevtsWP->have_posts() ) : $myevtsWP->the_post();
            $dateS = get_post_meta($id, '_event_start_date', true);
            $dateH = get_post_meta($id, '_event_start_time', true);
            $dateJ = date("d F Y", strftime(strtotime($dateS)));
            $dateh = date("H\hi", strtotime($dateH));
            $jour = str_replace_assoc($replace,$dateJ); 
            $heure = str_replace_assoc($replace,$dateh); 
            $id_loc = get_post_meta($id, '_location_id', true);$location = new EM_Location($id_loc);?>
            <?php //echo '<p>Le <time datetime="'.get_post_meta($id, '_event_start_date', true).' '..'">'.$jour.' à '.$heure.'</time></p>';?>
            <li><a href="<?php the_permalink(); ?>"><time datetime="<?php echo get_post_meta($id, '_event_start_date', true).' '.get_post_meta($id, '_event_start_time', true); ?>"><?php echo $jour; ?></time> <?php echo $location->location_name; ?>, <?php echo $location->location_town; ?></a></li>
        <?php endwhile;?>
        </ul>
        <?php endif;
	$myevts = EM_Events::get( array(
            'scope'=>'future',
            'orderby'=>'name',
            /*'meta_query' => array(
				'relation' => 'AND',
				array(
						'key' => 'programme_associe',
						'value' => '"' . $idP . '"',
                                                'compare' => 'LIKE'
				),
		),*/
            //'meta_key'		=> 'programme_associe',
            //'meta_value'	=> '"' . $idP . '"',
            ) 
         );//$programme = $EM_Event->event_attributes[programme_associe];
    //var_dump($myevts);?>
        <h3>Dates</h3>
        <ul id="dates">
        <?php foreach($myevts as $myevt):
        $date = date("d F Y", strftime(strtotime($myevt->start_date)));
        //print_r($date);
        $jour = str_replace_mois($replace,$date);
        //print_r($jour);
        $location = new EM_Location($myevt->location_id);
        $programme = $myevt->event_attributes[programme_associe];
        //print_r(get_the_ID().' - '.$programme);
        if($programme == get_the_ID()):?>
            <li><a href="<?php echo $myevt->guid; ?>"><time datetime="<?php echo $date; ?>"><?php echo $jour; ?></time> <?php echo $location->location_name; ?>, <?php echo $location->location_town; ?></a></li>
        <?php //print_r($myevt);
        //print_r($location);
        endif;
        endforeach;?></ul><?php endif; ?>
    </figure>
    <main class="col-md-5">
        <?php the_content(); ?>
    </main>
        <?php endwhile; endif; ?>
    <aside class="col-md-offset-1 col-md-3" id="sidebar">
    <?php //the_post_thumbnail('full'); ?>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ma_sidebar') ) : ?><?php endif; ?>
</aside>
</section>
<?php get_footer(); ?>