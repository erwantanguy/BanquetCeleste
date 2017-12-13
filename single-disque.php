<?php get_header(); ?>
<section class="row">
<h1 class="col-sm-12 col-md-12"><?php the_title(); ?></h1>
<h2 class="col-sm-12 col-md-12"><?php the_field('sous-titre'); ?></h2>
<nav class="col-sm-12 col-md-12" id="breadcrumbs"><?php yoast_breadcrumb('<p class="breadcrumb">','</p>');?>
</nav>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <main class="col-sm-12">
        <figure class="col-sm-4">
        
        <?php if(get_field('link')): ?><a href="<?php the_field('link'); ?>" data-toggle="tooltip" data-placement="top" title="Pour commander - <?php the_field('label'); ?>"><?php endif;?>
        <?php the_post_thumbnail('full'); ?>
            <?php if(get_field('link')): ?></a><?php endif;?>
        <?php if(get_field('label')): ?>
        <h3><?php the_field('label'); ?></h3>
        <?php endif; ?>
        <?php if( have_rows('audio') ):?>
        <div id="audio">
            <h4 class="hidden"><i class="fa fa-music" aria-hidden="true"></i> Extrait(s) sonore(s)</h4>
            <?php while ( have_rows('audio') ) : the_row();

               if( get_row_layout() == 'fichier' ):?>

                       <?php echo do_shortcode('[audio src="'.get_sub_field('son').'"]');?>

               <?php elseif( get_row_layout() == 'url' ):?>

                       <?php echo do_shortcode('[audio src="'.get_sub_field('audio').'"]');?>

               <?php endif;

           endwhile;?>
        </div>
       <?php endif; ?>
        <?php if(get_field('link')): ?>
        <a href="<?php the_field('link'); ?>" class="btn btn-default link"><i class="fa fa-external-link" aria-hidden="true"></i> <?php if(get_field('label')): ?>Acheter l'album</a><!--  <?php the_field('label');?> pour commander<?php else: ?>Pour commander<?php endif; ?>-->
        <?php endif; ?>
        <?php $programme = get_field('programme')[0]->ID;//print_r(get_field('programme')); ?>
        <a href="<?php echo get_post_permalink($programme); ?>" class="btn btn-default link hidden">Voir le programme</a>
        <?php if( have_rows('recompenses') ):?>
        <div id="recompenses">
        <?php while ( have_rows('recompenses') ) : the_row();$image = get_sub_field('image');?>
            <?php //print_r($image[sizes][recompense]); ?>
        <img src="<?php echo $image[sizes][recompense]; ?>" alt="<?php echo $image['alt'] ?>" />
        <?php if (get_sub_field('texte')):?>
        <p><?php the_sub_field('texte'); ?></p>
        <?php endif;?>     
        <?php endwhile; ?>
        </div>
        <?php endif; ?>
        </figure>
        
        <div id="content" class="col-sm-8">
            <?php the_content(); ?>
                <?php if ($programme): ?>
                <?php $presse = new WP_Query(
                    [
                        'post_type' => 'presse',
                        'meta_key' => 'programme_associe',
                        'meta_value' => $programme,
                    ]
                    );
                                        //var_dump($presse);?>
            <?php if($presse->have_posts()):?>
            <h3 class="separateur">Dans la presse</h3>
                <?php while ($presse->have_posts()):
                $presse->the_post();?>
            <article class="presse" id="presse-<?php the_id(); echo '-'.$programme; ?>">
                <blockquote><?php the_excerpt();?></blockquote>
            <?php if(get_field('lien')): ?>
            <a class="" href="<?php the_field('lien'); ?>"><?php if(get_field('source')): ?><?php the_field('source'); else :?>Voir la source<?php endif;//btn btn-default  ?></a>
            <?php endif; ?>
            </article>
                <?php endwhile;
            endif;
            ?>
            <?php endif; ?>
        </div>
    
        
    </main>
        <?php endwhile; endif; ?>
</section>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php if(get_field('video')):?>
<section id="video" class="row">
    <div class="col-sm-offset-2 col-sm-8"> 
    <h4 class="border hidden"><i class="fa fa-video-camera" aria-hidden="true"></i>
 Extrait(s) vidéo</h4>
    <div class="embed-responsive embed-responsive-16by9">
        <?php the_field('video'); ?>
    </div>
    </div>
</section>
<?php endif;?><?php endwhile; endif; ?>

<?php //get_template_part('widget'); ?>
<?php get_footer(); ?>