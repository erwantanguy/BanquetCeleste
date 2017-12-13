<?php if ( is_front_page() ) {?>
<section id="slider" class="row">
    <h1 class="col-md-12 text-center">Prochains concert</h1>
<?php 
    $today = getdate (); 
    $args = array(
        //'post_type'=>array(TribeEvents::POSTTYPE),
         'post_type'=>'event',
        'posts_per_page'=>5,
        'tax_query' => array(
          array(
            //'taxonomy' => 'event-categories',
            //'field'    => 'slug',
            //'terms'    => $termst,
            //'posts_per_page' => -1,
            'meta_key' => '_event_start_date', 
            'meta_query' => array( array( 'meta_key' => '_event_start_date' , 'meta_value' => $today, 'compare' => '>=' , 'type' => 'date')),
            'orderby' => 'meta_value'
                ),
        ),
      );
      $query = new WP_Query($args);
    function str_replace_assoc(array $replace, $subject) {
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
     ?>
    <div class="col-md-12 carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php $slideIMG = 0; if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post(); ?>
            <div rel="<?php echo $slideIMG; ?>" class="item<?php if($slideIMG===0) {?> active<?php } ?>">
                
                    <?php the_post_thumbnail('full'); ?>
                    <div class="carousel-caption">
                          <?php
                            $dateS = get_post_meta($id, '_event_start_date', true);
                            $dateH = get_post_meta($id, '_event_start_time', true);
                            $dateJ = date("d F Y", strftime(strtotime($dateS)));
                            $dateh = date("H\hi", strtotime($dateH));
                            $jour = str_replace_assoc($replace,$dateJ); 
                            $heure = str_replace_assoc($replace,$dateh); 
                            $id_loc = get_post_meta($id, '_location_id', true);$location = new EM_Location($id_loc);
                        ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <h3><?php echo $location->location_name; ?></h3>
                        <p>Le <time datetime="<?php echo get_post_meta($id, '_event_start_date', true)." ".get_post_meta($id, '_event_start_time', true); ?>"><?php echo $jour; ?> à <?php echo $heure; ?></time></p> 
                    </div>
                
            </div>
            <?php $slideIMG++;endwhile; endif; ?>
        </div>
    </div>
</section>
<?php }?>