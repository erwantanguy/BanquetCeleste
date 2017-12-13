<?php 
/*
Template Name: Contact
*/
get_header(); ?>
<section class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
    <?php if(get_field('colonne_1')):?>
    <div class="col-sm-4">
        <?php the_field('colonne_1');?>
    </div>
    <?php endif; ?>
    <?php if(get_field('colonne_2')):?>
    <div class="col-sm-4">
        <?php the_field('colonne_2');?>
    </div>
    <?php endif; ?>
    <?php if(get_field('colonne_3')):?>
    <div class="col-sm-4">
        <?php the_field('colonne_3');?>
    </div>
    <?php endif; ?>
    <main id="formulaire" class="col-sm-12 text-center">
        <?php echo do_shortcode(get_field('formulaire')); ?>
    </main>
</section>
<?php get_footer(); ?>