<?php get_header(); ?>
<section class="row" id="thumbnail">
    <div class="col-md-12">
         <?php the_post_thumbnail('full'); ?>
    </div>
</section>
<section class="row">
<h1 class="col-sm-12 col-md-12"><?php the_title(); ?></h1>
<nav class="col-sm-12 col-md-12" id="breadcrumbs"><?php yoast_breadcrumb('<p class="breadcrumb">','</p>');?>
</nav>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<main class="col-md-offset-3 col-md-6">
    <?php the_content(); ?>
</main>
<?php endwhile; endif; ?>
</section>
<?php get_template_part('widget'); ?>
<?php get_footer(); ?>