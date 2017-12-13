<?php

/*
Template Name: Musiciens
*/

get_header(); ?>
<section class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
    <?php if(get_the_post_thumbnail()):?>
    <figure class="col-md-12 text-center">
        <?php the_post_thumbnail('full'/*, array('class' => 'img-thumbnail')*/); ?>
    </figure>
    <?php endif; ?>
    <main id="musiciens" class="col-md-12">
        <div id="liste">
        <?php //the_content(); ?>
        <?php
        
        // check if the repeater field has rows of data
        if( have_rows('liste') ):

                // loop through the rows of data
            while ( have_rows('liste') ) : the_row();?>
        <article class="col-sm-3">
            <figure>
                <?php //
                $image = get_sub_field('image');
                if( !empty($image) ): ?>
                <!--<a href="<?php //echo $image['url']; ?>"></a>-->
                <a href="#prez-<?php echo get_row_index(); ?>" data-toggle="modal" data-target="#prez-<?php echo get_row_index(); ?>">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                </a>
                <div class="modal fade" id="prez-<?php echo get_row_index(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel"><?php the_sub_field('nom');?></h4>
                          <h5><?php the_sub_field('presentation');?></h5>
                        </div>
                            <div class="modal-body">
                              <?php the_sub_field('texte');?>
                                <?php if(get_sub_field('mail')||get_sub_field('website')||get_sub_field('phone')): ?>
                                <aside>
                                    <?php if(get_sub_field('mail')): ?>
                                    <a href="<?php the_sub_field('mail'); ?>"><i class="fa fa-envelope-o" aria-hidden="true">&nbsp;</i><?php the_sub_field('mail'); ?></a>
                                    <?php endif; if(get_sub_field('website')): ?>
                                    <a href="<?php the_sub_field('website'); ?>"><i class="fa fa-external-link" aria-hidden="true">&nbsp;</i><?php the_sub_field('website'); ?></a>
                                    <?php endif; if(get_sub_field('phone')): ?>
                                    <a href="<?php the_sub_field('phone'); ?>"><i class="fa fa-phone" aria-hidden="true">&nbsp;</i><?php the_sub_field('phone'); ?></a>
                                    <?php endif; ?>
                                </aside>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="prez">
                    <h3><?php the_sub_field('nom'); ?></h3>
                    <h4><?php the_sub_field('presentation');?></h4>
                </div>
                <?php endif; ?>
            </figure>
        </article>

            <?php endwhile;

        else :?>

            <h2 class="text-center" style="font-weight: 300;font-style: italic;"><?php the_field('texte_temporaire'); ?></h2>

        <?php endif;

        ?>
        </div>
    </main>
</section>
<?php get_footer(); ?>