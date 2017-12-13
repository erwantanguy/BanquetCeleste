<?php get_header(); ?>
<div class="row">
    <h1 class="col-md-12 text-center"><?php single_cat_title(); ?></h1>
</div>
<?php if(have_posts()): ?>
<?php
        while ( have_posts() ):
		the_post();
?>
<article class="row">
    <header class="col-sm-7 col-md-9">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <time class="hidden-xs hidden-sm" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php the_date(); ?></time>
        <div class="hidden-sm"><?php the_excerpt(); ?></div>
        <p class="visible-sm-block"><?php echo excerpt(15);?></p>
    </header>
    <aside class="col-sm-5 col-md-3">
        <a href="<?php the_permalink(); ?>">
        <?php 
            the_post_thumbnail('full'); 
            ?>
        </a>
    </aside>
</article>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>