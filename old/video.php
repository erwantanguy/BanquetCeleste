<?php

/*
Template Name: Vidéo
*/




get_header(); ?>
<div class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
</div>
<?php

// check if the repeater field has rows of data
if( have_rows('video') ):?>
<section class="row">
    <h2 class="col-sm-12">Interviews</h2>
    <?php while ( have_rows('video') ) : the_row();?>
    <div id="interviews" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <?php the_sub_field('video'); ?>
                <div class="carousel-caption">
                    <h3><a href="<?php the_sub_field('lien')?>"><?php the_sub_field('titre'); ?></a></h1>
                    <p><?php the_sub_field('descriptif') ?></p>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#interviews" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#interviews" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <article class="col-sm-6 col-md-4">
        <?php if(get_sub_field('video')):?>
            <div class="embed-responsive embed-responsive-16by9">
                <?php the_sub_field('video'); ?>
            </div>
        <?php endif; ?>
        <h1><a href="<?php the_sub_field('lien')?>"><?php the_sub_field('titre'); ?></a></h1>
        <h2><?php the_sub_field('descriptif') ?></h2>
    </article>
    <?php endwhile;?>
</section>
<?php endif;

?>
<?php get_footer(); ?>