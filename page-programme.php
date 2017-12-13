<?php

/*
Template Name: Programmes
*/




get_header(); ?>
<div class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
</div>
<?php 
    $evs = new WP_Query( array( 
        'post_type' => 'programme',
        'meta_query' => array(
				'relation' => 'OR',
				array(
						'key' => 'programme',
						'value' => 'zone1',
				),
		),
        'posts_per_page' => '1000',
        ) );
    //print_r($evs);   if($evs->have_posts()):
    if($evs->have_posts()):
    ?>
<section id="zone1" class="row">
<?php
        while ( $evs->have_posts() ):
		$evs->the_post();
?>
<article class="col-sm-6 col-md-4">
    <figure>
        <a href="<?php the_permalink(); ?>">
        <?php 
            the_post_thumbnail('full'); 
            ?>
        </a>
    </figure>
    <header>
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <h2><?php the_field('musiciens'); ?></h2>
        <?php if(get_the_terms($post->ID, 'cat')): ?>
    <?php $cat = get_the_terms($post->ID, 'cat')[0]->name;//print_r(get_the_terms($post->ID, 'cat')[0]->name);?>
    <h3><?php echo $cat; ?></h3>
    <?php endif; ?>
    </header>
</article>
    <?php endwhile; ?>
</section>
<?php endif; ?>
<?php 
    $evs2 = new WP_Query( array( 
        'post_type' => 'programme',
        'meta_query' => array(
				'relation' => 'OR',
				array(
						'key' => 'programme',
						'value' => 'zone2',
				),
		),
//        'posts_per_page' => '4',
        ) );
    //print_r($evs);   if($evs->have_posts()):
    if($evs2->have_posts()):
    ?>
<section id="zone2" class="row">
<?php
        while ( $evs2->have_posts() ):
		$evs2->the_post();
?>
<article class="col-xs-6 col-sm-3">
    <figure>
        <a href="<?php the_permalink(); ?>">
        <?php 
            the_post_thumbnail('full'); 
            ?>
        </a>
    </figure>
    <header>
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <h2 class="hidden-xs hidden-sm"><?php the_field('musiciens'); ?></h2>
    </header>
</article>
    <?php endwhile; ?>
</section>
<?php endif; ?>
<?php //print_r($evs); ?>
<?php get_footer(); ?>