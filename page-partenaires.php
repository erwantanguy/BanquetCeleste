<?php
/*
Template Name: Partenaires
*/
 get_header(); ?>
<section class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
    <?php if(get_the_post_thumbnail()):?>
    <figure class="col-md-12 text-center">
        <?php //the_post_thumbnail('full'/*, array('class' => 'img-thumbnail')*/); ?>
    </figure>
    <?php endif; ?>
    <?php if( have_rows('partenaires') ):?>
    <div class="row">
    <?php while ( have_rows('partenaires') ) : the_row();?>
    <article class="col-md-12 clearfix">
        <figure class="col-md-2">
            <a href="<?php the_sub_field('lien'); ?>">
            <?php 
            $image = get_sub_field('logo');
            if( !empty($image) ): ?>
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
            <?php endif; ?>
            </a>
        </figure>
        <header class="col-md-10">
            <?php the_sub_field('texte') ?>
            <!--<a class="btn btn-default" href="<?php the_sub_field('lien'); ?>"><?php the_sub_field('lien'); ?></a>-->
        </header>
    </article> 
    <?php endwhile;?>
    </div>
    <?php endif;?>
</section>
<?php get_footer(); ?>