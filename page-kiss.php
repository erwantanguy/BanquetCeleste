<?php
/*
Template Name: Kiss
*/
get_header(); ?>
<section class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
    <?php if(get_field('sous_titre')):?>
    <h2><?php the_field('sous_titre'); ?></h2>
    <?php endif;?>
    <nav class="col-sm-12 col-md-12" id="breadcrumbs"><?php if($EM_Event->event_attributes[date]==1):yoast_breadcrumb('<p class="breadcrumb">',' <small>- en '.$nojour.'</small>
    </p>'); else:yoast_breadcrumb('<p class="breadcrumb">',' <small>- le '.$jour.' à '.$dateH.'</small>
    </p>'); endif;?>
    </nav>
    <main class="col-md-8 col-md-offset-2">
        <?php the_content(); ?>
        <?php if(get_field('video')): ?>
        <div class="embed-responsive embed-responsive-16by9">
            <?php the_field('video'); ?>
        </div>
        <?php endif; ?>
        <?php if(get_field('programme')):?>
            <?php the_field('programme'); ?>
        <?php endif;?>
        <?php if(get_the_post_thumbnail()):?>
        <figure>
            <?php if(get_field('lien')):?>
            <a href="<?php the_field('lien'); ?>"><?php the_post_thumbnail('full'/*, array('class' => 'img-thumbnail')*/); ?></a>
            <?php else: ?>
            <?php the_post_thumbnail('full'/*, array('class' => 'img-thumbnail')*/); ?>
            <?php endif; ?>
        </figure>
        <?php endif; ?>
    </main>
</section>
<?php get_footer(); ?>