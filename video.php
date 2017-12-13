<?php

/*
Template Name: Vidéo
*/

get_header(); ?>
<div class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
</div>

<section id="lesvideos" class="row">
    <figure id="vue" class="col-sm-6">
       <?php $i = 0;while ( have_rows('video') ) : the_row();?>
        <?php if($i == 0):?>
       <div class="embed-responsive embed-responsive-16by9"> 
            <?php the_sub_field('video'); ?>
       </div>
        <h3><?php the_sub_field('titre'); ?></h3>
        <p><?php the_sub_field('descriptif') ?></p>
        <?php endif; $i++; ?>
        <?php endwhile; ?>
    </figure>
    <nav class="col-sm-5">
        <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Interviews</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Concerts</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Enregistrements</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="home">
          <?php if( have_rows('video') ):?>
        <?php $i = 0;while ( have_rows('video') ) : the_row();?>
        <?php if($i <= 4):?>
          <div class="row">
            <?php if(get_sub_field('identifiant')):$num=rand(0,3);$num=0;?>
            <figure class="col-sm-3 hidden-xs">
                <img src="http://img.youtube.com/vi/<?php the_sub_field('identifiant'); ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="video" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php else:$num=rand(0,3);$num=0;
            $code = get_sub_field('video');
            preg_match('/<iframe(.*)src(.*)=(.*)"(.*)"/U', $code, $result);
            $info = array_pop($result);
            $thumbnail = substr($info, 30);
                        //print_r($thumbnail);
            ?>
            <figure class="col-sm-3 hidden-xs">
                <img src="http://img.youtube.com/vi/<?php echo $thumbnail; ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="video" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php endif;?>
            <p data-cat="video" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>" class="col-sm-9 load"><?php the_sub_field('titre'); ?></a></p>
        </div>
        <?php endif; $i++; ?>
        <?php endwhile;?>
        <?php endif; ?>
      </div>
      <div role="tabpanel" class="tab-pane" id="profile">
          <?php if( have_rows('concerts') ):?>
        <?php $i = 0;while ( have_rows('concerts') ) : the_row();?>
        <?php if($i <= 4):?>
          <div class="row">
            <?php if(get_sub_field('identifiant')):$num=rand(0,3);$num=0;?>
            <figure class="col-sm-3 hidden-xs">
                <img src="http://img.youtube.com/vi/<?php the_sub_field('identifiant'); ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="concerts" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php else:$num=rand(0,3);$num=0;
            $code = get_sub_field('video');
            preg_match('/<iframe(.*)src(.*)=(.*)"(.*)"/U', $code, $result);
            $info = array_pop($result);
            $thumbnail = substr($info, 30);
                        //print_r($thumbnail);
            ?>
            <figure class="col-sm-3 hidden-xs">
                <img src="http://img.youtube.com/vi/<?php echo $thumbnail; ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="concerts" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php endif;?>
            <p data-cat="concerts" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>" class="col-sm-9 load"><?php the_sub_field('titre'); ?></a></p>
        </div>
        <?php endif; $i++; ?>
        <?php endwhile;?>
        <?php endif; ?>
      </div>
      <div role="tabpanel" class="tab-pane" id="messages">
          <?php if( have_rows('enregistrements') ):?>
        <?php $i = 0;while ( have_rows('enregistrements') ) : the_row();?>
        <?php if($i <= 4):?>
          <div class="row">
            <?php if(get_sub_field('identifiant')):$num=rand(0,3);$num=0;?>
            <figure class="col-sm-3 hidden-xs">
                <img src="http://img.youtube.com/vi/<?php the_sub_field('identifiant'); ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="enregistrements" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php else:$num=rand(0,3);$num=0;
            $code = get_sub_field('video');
            preg_match('/<iframe(.*)src(.*)=(.*)"(.*)"/U', $code, $result);
            $info = array_pop($result);
            $thumbnail = substr($info, 30);
                        //print_r($thumbnail);
            ?>
            <figure class="col-sm-3 hidden-xs">
                <img src="http://img.youtube.com/vi/<?php echo $thumbnail; ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="enregistrements" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php endif;?>
            <p data-cat="enregistrements" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>" class="col-sm-9 load"><?php the_sub_field('titre'); ?></a></p>
        </div>
        <?php endif; $i++; ?>
        <?php endwhile;?>
        <?php endif; ?>
      </div>
  </div>

</div>
        <!--
        <?php if( have_rows('video') ):?>
        <dl>
        <dt class="col-sm-12">Interviews</dt>
        <dd id="interviews" class="row">
        <?php $i = 0;while ( have_rows('video') ) : the_row();?>
        <?php if($i <= 4):?>
            <?php if(get_sub_field('identifiant')):$num=rand(0,3);$num=0;?>
            <figure class="col-sm-2">
                <img src="http://img.youtube.com/vi/<?php the_sub_field('identifiant'); ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="enregistrements" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php else:$num=rand(0,3);$num=0;
            $code = get_sub_field('video');
            preg_match('/<iframe(.*)src(.*)=(.*)"(.*)"/U', $code, $result);
            $info = array_pop($result);
            $thumbnail = substr($info, 30);
                        //print_r($thumbnail);
            ?>
            <figure class="col-sm-2">
                <img src="http://img.youtube.com/vi/<?php echo $thumbnail; ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="enregistrements" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php endif;?>
            <p data-cat="video" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>" class="col-sm-10 load"><?php the_sub_field('titre'); ?></a></p>
        <?php endif; $i++; ?>
        <?php endwhile;?>
        </dd>
        </dl>
        <?php endif; ?>
        <?php if( have_rows('concerts') ):?>
        <dl>
        <dt class="col-sm-12">Concerts</dt>
        <dd id="concerts" class="row">
        <?php $i = 0;while ( have_rows('concerts') ) : the_row();?>
        <?php if($i <= 4):?>
            <?php if(get_sub_field('identifiant')):$num=rand(0,3);$num=0;?>
            <figure class="col-sm-2">
                <img src="http://img.youtube.com/vi/<?php the_sub_field('identifiant'); ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="enregistrements" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php else:$num=rand(0,3);$num=0;
            $code = get_sub_field('video');
            preg_match('/<iframe(.*)src(.*)=(.*)"(.*)"/U', $code, $result);
            $info = array_pop($result);
            $thumbnail = substr($info, 30);
                        //print_r($thumbnail);
            ?>
            <figure class="col-sm-2">
                <img src="http://img.youtube.com/vi/<?php echo $thumbnail; ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="enregistrements" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php endif;?>
            <p data-cat="concerts" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>" class="col-sm-10 load"><?php the_sub_field('titre'); ?></a></p>
        <?php endif; $i++; ?>
        <?php endwhile;?>
        </dd>
        </dl>
        <?php endif; ?>
        <?php if( have_rows('enregistrements') ):?>
        <dl>
        <dt class="col-sm-12">Enregistrements</dt>
        <dd id="enregistrements" class="row">
        <?php $i = 0;while ( have_rows('enregistrements') ) : the_row();?>
        <?php if($i <= 4):?>
            <?php if(get_sub_field('identifiant')):$num=rand(0,3);$num=0;?>
            <figure class="col-sm-2">
                <img src="http://img.youtube.com/vi/<?php the_sub_field('identifiant'); ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="enregistrements" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php else:$num=rand(0,3);$num=0;
            $code = get_sub_field('video');
            preg_match('/<iframe(.*)src(.*)=(.*)"(.*)"/U', $code, $result);
            $info = array_pop($result);
            $thumbnail = substr($info, 30);
                        //print_r($thumbnail);
            ?>
            <figure class="col-sm-2">
                <img src="http://img.youtube.com/vi/<?php echo $thumbnail; ?>/<?php echo $num; ?>.jpg" alt="<?php the_sub_field('titre'); ?>" class="load" data-cat="enregistrements" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>">
            </figure>
            <?php endif;?>
            <p data-cat="enregistrements" data-id="<?php the_ID(); ?>" data-index="<?php echo get_row_index(); ?>" class="col-sm-10 load"><?php the_sub_field('titre'); ?></a></p>
        <?php endif; $i++; ?>
        <?php endwhile;?>
        </dd>
        </dl>
        <?php endif; ?>
        -->
    </nav>
</section>
<?php get_footer(); ?>