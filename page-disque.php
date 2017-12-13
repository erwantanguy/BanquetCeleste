<?php

/*
Template Name: Disques
*/

get_header(); ?>
<div class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
</div>

<section id="disque" class="row">
   <?php 
    $evs = new WP_Query( array( 'post_type' => 'disque' ) );
    //print_r($evs);
    if($evs->have_posts()):
        while ( $evs->have_posts() ):
		$evs->the_post();?>
    <article class="col-md-6">
        <figure class="col-sm-6">
            <?php print_r(get_the_post_thumbnail('disque')); ?>
        <a href="<?php the_permalink();?>"><?php the_post_thumbnail('disque'); ?></a>
        </figure>
        <header class="col-sm-6">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <?php echo wpautop(get_the_excerpt()); ?>
            <a href="<?php the_permalink(); ?>">En savoir +</a>
        </header>
    </article>
        <?php endwhile;endif;?>
</section>

<?php //print_r($evs); ?>
<?php get_footer(); ?>