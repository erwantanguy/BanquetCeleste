<?php

/*
Template Name: Accès PRO
*/

 get_header(); ?>
<section class="row">
    <h1 class="col-md-12 text-center"><?php the_title(); ?></h1>
    <?php if(get_the_post_thumbnail()):?>
    <figure class="col-md-12 text-center">
        <?php the_post_thumbnail('full'/*, array('class' => 'img-thumbnail')*/); ?>
    </figure>
    <?php endif; ?>
    <?php if ( ! is_user_logged_in() ) {?>
    <main id="access" class="col-md-12">
        <p>Cette zone est réservée aux professionnels ! Vous devez vous connecter pour y accéder ou contacter le Banquet Céleste pour obtenir un accès.</p>
        <?php wp_login_form( array(
        'redirect'       => site_url( '/acces-pro/' ), // par défaut renvoie vers la page courante
        'label_username' => 'Login',
        'label_password' => 'Mot de passe',
        'label_remember' => 'Se souvenir de moi',
        'label_log_in'   => 'Se connecter',
        'form_id'        => 'login-form',
        'id_username'    => 'user-login',
        'id_password'    => 'user-pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'remember'       => true, //afficher l'option se ouvenir de moi
        'value_remember' => false //se souvenir par défaut ?
        ) );?>
    </main>
    <?php } else {?>
    <main id="subtitle" class="col-md-12">
        <?php echo '<p>N\'oubliez pas de vous déconnecter avant de fermer le navigateur.</p><p><a href="' . wp_logout_url( site_url( '/' ) ) .'" class="button">Se déconnecter</a></p>';?>
        <?php the_content(); ?>
    </main>
    <?php if(get_field('2_colonnes')): ?>
    <main id="content" class="col-md-12">
        <?php the_field('2_colonnes'); ?>
    </main>
    <?php endif; }?>
</section>
<?php get_footer(); ?>