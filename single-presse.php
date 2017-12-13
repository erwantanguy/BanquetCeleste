<?php get_header(); ?>
<section class="row" id="thumbnail">
    <div class="col-md-12">
         <?php the_post_thumbnail('full'); ?>
    </div>
</section>
<section class="row">
<h1 class="col-sm-12 col-md-12"><?php the_title(); ?></h1>
<h2 class="col-sm-12 col-md-12"><?php the_field('sous-titre'); ?></h2>
<nav class="col-sm-12 col-md-12" id="breadcrumbs"><?php yoast_breadcrumb('<p class="breadcrumb">','</p>');?>
</nav>
    <?php if (have_posts()) : while (have_posts()) : the_post(); 
    $evlink = get_field('evenement_lie')[0]->guid;
            $ev = get_field('evenement_lie')[0]->ID;
            $evdate = em_get_event($ev, 'post_id')->event_start_date;
            $replace = array(
                'January' => 'janvier',
                'February' => 'février',
                'March' => 'mars',
                'April' => 'avril',
                'May' => 'mai',
                'June' => 'juin',
                'July' => 'juillet',
                'August' => 'août',
                'September' => 'septembre',
                'October' => 'octobre',
                'November' => 'novembre',
                'December' => 'décembre',
            );
            $dateJ = date("d F Y", strftime(strtotime($evdate)));
            $jour = str_replace_assoc($replace,$dateJ);
    
    ?>
    <main class="col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
        <?php if(get_field('lien')): ?>
        <h2><a id="link<?php the_id(); ?>" href="<?php the_field('lien'); ?>">
                <?php if(get_field('source')): ?>Voir la source sur <?php the_field('source'); else :?>Voir la source<?php endif; ?>
            </a></h2>
        <?php endif; ?>
        <?php the_content(); ?>
        
        <?php if(get_field('evenement_lie')):?>
        <p><a href="<?php echo $evlink; ?>" class="btn btn-default"><time datetime='<?php echo $evdate; ?>'><?php echo $jour; ?></time> - <?php echo em_get_event($ev, 'post_id')->get_location()->name; ?></a></p>
        <?php endif; ?>
        <?php if(get_field('video')):?>
        <h4 class="border">
            <i class="fa fa-video-camera" aria-hidden="true"></i>
            Extrait(s) vidéo
        </h4>
        <div class="embed-responsive embed-responsive-16by9">
            <?php the_field('video'); ?>
        </div>
        <?php endif;?>
    </main>
        <?php endwhile; endif; ?>
</section>
<?php //get_template_part('widget'); ?>
<?php get_footer(); ?>