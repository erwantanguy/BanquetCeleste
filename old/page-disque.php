<?php

/*
Template Name: Disques
*/




get_header(); ?>
<div class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
</div>
<?php 
    $evs = new WP_Query( array( 'post_type' => 'disque' ) );
    //print_r($evs);
    if($evs->have_posts()):
        while ( $evs->have_posts() ):
		$evs->the_post();
?>
<article class="row">
    <header class="hidden-xs col-sm-6 col-md-6 col-md-push-3">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <h2><?php the_field('sous-titre'); ?></h2>
        <?php if($programme): ?>
            <a href="<?php echo get_post_permalink($programme); ?>" class="btn btn-default"><i class="fa fa-file-text-o" aria-hidden="true"></i>
 Voir le programme complet</a>
        <?php endif; ?>
        <?php if(get_field('link')): ?>
        <a href="<?php the_field('link'); ?>" class="btn btn-default" id="link<?php the_id(); ?>"><i class="fa fa-external-link" aria-hidden="true"></i>
 Commander le disque - <?php the_field('label'); ?></a>
        <?php endif; ?>
    </header>
    <main class="hidden-xs hidden-sm col-md-3 col-md-pull-6">
        <h3><?php the_field('label') ?></h3>
        <?php if( have_rows('audio') ):?>
        <div id="audio">
        <h4>Extrait(s) sonore(s)</h4>
            <?php while ( have_rows('audio') ) : the_row();

               if( get_row_layout() == 'fichier' ):?>

                       <?php echo do_shortcode('[audio src="'.get_sub_field('son').'"]');?>

               <?php elseif( get_row_layout() == 'url' ):?>

                       <?php echo do_shortcode('[audio src="'.get_sub_field('audio').'"]');?>

               <?php endif;

           endwhile;?>
        </div>
       <?php endif; ?>
    </main>
    <aside class="col-xs-12 col-sm-6 col-md-3">
        <a href="<?php the_permalink(); ?>">
        <?php 
            the_post_thumbnail('full'); 
            ?>
        </a>
    </aside>
</article>
    <?php endwhile;
    endif;
?>

<?php //print_r($evs); ?>
<?php get_footer(); ?>