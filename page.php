<?php get_header(); ?>
<section class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
    <?php if(get_the_post_thumbnail()):?>
    <figure class="col-md-12 text-center">
        <?php the_post_thumbnail('full'/*, array('class' => 'img-thumbnail')*/); ?>
    </figure>
    <?php endif; ?>
    <main id="subtitle" class="col-md-12">
        <?php the_content(); ?>
    </main>
    <?php if(get_field('2_colonnes')): ?>
    <main id="content" class="col-md-12">
        <?php the_field('2_colonnes'); ?>
    </main>
    <?php endif; ?>
</section>
<?php get_footer(); ?>