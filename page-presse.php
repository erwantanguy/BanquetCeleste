<?php

/*
Template Name: Presse
*/

get_header(); ?>
<div class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
</div>
<?php 
    $evs = new WP_Query( array( 'post_type' => 'presse' ) );
    //print_r($evs);
    if($evs->have_posts()):
        while ( $evs->have_posts() ):
		$evs->the_post();
                //print_r(get_field('evenement_lie'));
                //$evlink = get_field('evenement_lie')[0]->guid;
            $ev = get_field('evenement_lie')[0]->ID;
            $evlink = get_post_permalink($ev);
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
<article class="row">
    <header class="col-sm-4 col-md-6 col-md-push-3">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php if(get_field('evenement_lie')):?>
        <h2><a href="<?php echo $evlink; ?>"><time datetime='<?php echo $evdate; ?>'><?php echo $jour; ?></time> - <?php echo em_get_event($ev, 'post_id')->get_location()->name; ?></a></h2>
        <?php endif; ?>
        <?php if(get_field('lien')): ?>
            <a id="link<?php the_id(); ?>" class="btn btn-default pull-right" href="<?php the_field('lien'); ?>"><?php if(get_field('source')): ?>Sur <?php the_field('source'); else :?>Voir la source<?php endif; ?></a>
            <?php endif; ?>
    </header>
    <main class="col-sm-4 col-md-3 col-md-pull-6">
        <blockquote><p><?php echo excerpt(27); ?></p></blockquote>
    </main>
    <aside class="col-sm-4 col-md-3">
        <a href="<?php the_permalink(); ?>">
        <?php if(get_field('video')):?>
        <div class="embed-responsive embed-responsive-16by9">
            <?php the_field('video'); ?>
        </div>
        <?php else: ?>
        <?php the_post_thumbnail('full'); ?>
    <?php endif;?>
        </a>
    </aside>
</article>
    <?php endwhile;
    endif;
?>

<?php //print_r($evs); ?>
<?php get_footer(); ?>