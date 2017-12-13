<?php
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );
set_post_thumbnail_size( 150, 150, array( 'center', 'center')  );
add_theme_support( 'menus' );

/**** SINGLE par cat ****/

add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-{$cat->term_id}.php") ) return TEMPLATEPATH . "/single-{$cat->term_id}.php"; } return $t;' ));

/********* post type *********/

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'disque',
    array(
      'labels' => array(
        'name' => __( 'Disques ' ),
        'singular_name' => __( 'Disque ' ),
        'all_items' => 'Toutes les disques',
      'add_new_item' => 'Ajouter un disque',
      'edit_item' => 'Éditer le disque',
      'new_item' => 'Nouveau disque',
      'view_item' => 'Voir le disque',
      'search_items' => 'Rechercher parmi les disques',
      'not_found' => 'Pas de disque trouvé',
      'not_found_in_trash'=> 'Pas de disque dans la corbeille'
      ),
      'public' => true,
      'supports'=>array('title','editor','thumbnail','excerpt','revisions'),
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
    )
  );
  register_post_type( 'programme',
  array(
  'labels' => array(
  'name' => __( 'Programmes ' ),
  'singular_name' => __( 'Programme ' ),
  'all_items' => 'Tous les programmes',
  'add_new_item' => 'Ajouter un programme',
  'edit_item' => 'Éditer le programme',
  'new_item' => 'Nouveau programme',
  'view_item' => 'Voir le programme',
  'search_items' => 'Rechercher parmi les programmes',
  'not_found' => 'Pas de programme trouvé',
  'not_found_in_trash'=> 'Pas de programme dans la corbeille'
  		),
  		'public' => true,
  		'supports'=>array('title','editor','thumbnail','excerpt','revisions'),
  		'query_var' => true,
  		'rewrite' => true,
  		'capability_type' => 'post',
  )
  );
  register_post_type( 'presse',
  array(
  'labels' => array(
  'name' => __( 'Presse ' ),
  'singular_name' => __( 'Presse ' ),
  'all_items' => 'Toute la presse',
  'add_new_item' => 'Ajouter un article de presse',
  'edit_item' => 'Éditer l\'article',
  'new_item' => 'Nouvel article',
  'view_item' => 'Voir l\'article',
  'search_items' => 'Rechercher parmi les articles de presse',
  'not_found' => 'Pas d\'article trouvé',
  'not_found_in_trash'=> 'Pas d\'article dans la corbeille'
  		),
  		'public' => true,
  		'supports'=>array('title','editor','thumbnail','excerpt','revisions'),
  		'query_var' => true,
  		'rewrite' => true,
  		'capability_type' => 'post',
  )
  );
  /*register_post_type( 'archive',
  array(
  'labels' => array(
  'name' => __( 'Archives ' ),
  'singular_name' => __( 'Archive ' ),
  'all_items' => 'Toutes les archives',
  'add_new_item' => 'Ajouter une archive',
  'edit_item' => 'Éditer la archive',
  'new_item' => 'Nouvelle archive',
  'view_item' => 'Voir la archive',
  'search_items' => 'Rechercher parmi les archives',
  'not_found' => 'Pas de archive trouvée',
  'not_found_in_trash'=> 'Pas de archive dans la corbeille'
  		),
  		'public' => true,
  		'supports'=>array('title','editor','thumbnail','excerpt','revisions'),
  		'query_var' => true,
  		'rewrite' => true,
  		'capability_type' => 'post',
  )
  );*/
  register_taxonomy('categorie','disque',array( 'hierarchical' => false, 'label' => 'Catégories', 'query_var' => true, 'rewrite' => array( 'slug' => 'categorie' ) ));
  register_taxonomy('reference','disque',array( 'hierarchical' => false, 'label' => 'Type de structures', 'query_var' => true, 'rewrite' => array( 'slug' => 'reference' ) ));
  //register_taxonomy('tagexpo','disque',array( 'hierarchical' => false, 'label' => 'Références clients', 'query_var' => true, 'rewrite' => array( 'slug' => 'tags' ) ));
  //register_taxonomy('category','reference',array( 'hierarchical' => false, 'label' => 'Catégories', 'query_var' => true, 'rewrite' => array( 'slug' => 'categorie' ) ));
  //register_taxonomy('tag','reference',array( 'hierarchical' => false, 'label' => 'Tags', 'query_var' => true, 'rewrite' => array( 'slug' => 'tags' ) ));
  //register_taxonomy('cat','archive',array( 'hierarchical' => false, 'label' => 'Catégories', 'query_var' => true, 'rewrite' => array( 'slug' => 'categorie' ) ));
  register_taxonomy('cat','programme',array( 'hierarchical' => false, 'label' => 'Catégorie du programme', 'query_var' => true, 'rewrite' => array( 'slug' => 'categorie_programme' ) ));
}

/**** options ACF ****/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Page Accueil Banquet Céleste',
		'menu_title'	=> 'Theme Banquet Céleste',
		'menu_slug' 	=> 'banquetceleste',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Gestion de la page d\'accueil',
		'menu_title'	=> 'Accueil',
		'parent_slug'	=> 'banquetceleste',
	));
	/*acf_add_options_sub_page(array(
	'page_title' 	=> 'Theme Header Settings',
	'menu_title'	=> 'Header',
	'parent_slug'	=> 'theme-general-settings',
	));*/

}

/************* WIDGETS *************/

add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => 'ma_sidebar',
        //'id' => 1,
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
	register_sidebar( array(
        'name' => 'page',
        //'id' => 4,
        //'title' => 'Recherche',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
	register_sidebar( array(
        'name' => 'home',
        //'id' => 4,
        //'title' => 'Recherche',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
	register_sidebar( array(
        'name' => 'footer_1',
        //'id' => 4,
        //'title' => 'Recherche',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
	register_sidebar( array(
        'name' => 'footer_2',
        //'id' => 4,
        //'title' => 'Recherche',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
	register_sidebar( array(
        'name' => 'footer_3',
        //'id' => 4,
        //'title' => 'Recherche',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
        register_sidebar( array(
        'name' => 'footer_4',
        //'id' => 4,
        //'title' => 'Recherche',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
}

/* MENU */


register_nav_menus(array(
	'premier' => 'Menu principale home',
	'second' => 'Menu principale',
	'deuxieme' => 'Petit menu optionnel',
	'troisieme' => 'Menu pied de page',
	'lieux' => 'Menu des lieux',
	//'oeuvres' => 'Menu pour les oeuvres quand il n\'y a pas d\'événements'
));


$args = array(
	'flex-width'    => true,
	'width'         => 1900,
	'flex-height'    => true,
	'height'        => 284,
	//'default-image' => 'http://www.ticoet.fr/drmgalerie/wp-content/uploads/sites/12/2015/09/bandeau_defaut.png', //get_template_directory_uri() . 
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );

/*********** IMAGES ************/

add_image_size( 'events', 300, 120, array( 'left', 'top' ) );
add_image_size( 'event', 300,120 );
add_image_size('mobile',768);
add_image_size('mobile1',768,270,array( 'center', 'center' ));
add_image_size('mobile2',768,512,array( 'center', 'center' ));
add_image_size('mobile3',768,328,array( 'center', 'center' ));
add_image_size('oeuvres',275, 206, true);
add_image_size('home_oeuvres',390, 295, true);
add_image_size('disque',400, 400, array( 'center', 'center' ));
add_image_size('tablette',1000);
add_image_size('sidebar',360);
add_image_size('boutique',250);
//add_image_size('vignette',225,225,array( 'left', 'top' ));
add_image_size('vignette',225,225,array( 'center', 'center' ));
add_image_size('news',390,390,array( 'center', 'center' ));
add_image_size('vignetteAccueil',410,410,array( 'center', 'center' ));
add_image_size('calendar', 294,154);
add_image_size('lactu',180,135,array( 'center', 'center' ));
add_image_size('lactu2',180,100,array( 'center', 'center' ));
add_image_size('page',1140,400,array( 'center', 'center' ));
add_image_size('slider',1142,502,array( 'center', 'center' ));
add_image_size('box',2000);
add_image_size('recompense',100);

/************ menu boostrap **********/

class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {

   function start_lvl(&$output, $depth = 0, $args = array()) {
      $output .= "\n<ul class=\"dropdown-menu\">\n";
   }

   function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
       $element_html = '';
       parent::start_el($element_html, $item, $depth, $args);
       if ( $item->is_dropdown && $depth === 0 ) {
           $element_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $element_html );
           $element_html = str_replace( '</a>', ' <b class="caret"></b></a>', $element_html );
       }
       $output .= $element_html;
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        if ( $element->current ) {
            $element->classes[] = 'active';
        }
        $element->is_dropdown = !empty( $children_elements[$element->ID] );
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
class theme_blue_walker_nav_menu extends Walker_Nav_Menu{
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){
		$element_html = '';
		parent::start_el($element_html, $item, $depth, $args);
		//if ( $item->is_dropdown && $depth === 0 ) {
			$element_html = str_replace( '<a', '<a class="inner-link"', $element_html );
		//}
		$output .= $element_html;
	}
}


/************ JS ***************/
add_action('init', 'gkp_insert_js_in_footer');
function gkp_insert_js_in_footer() {
     if( !is_admin() ) :
        wp_deregister_script( 'jquery' );
        //wp_enqueue_style( 'style', get_stylesheet_uri() );
        wp_register_script( 'jquery', get_bloginfo( 'template_directory' ).'/js/jquery-2.2.4.min.js','',false,true);
        wp_enqueue_script( 'jquery' );
        wp_register_script('functions', get_bloginfo( 'template_directory' ).'/js/bootstrap.min.js','',false,true);
        wp_enqueue_script( 'functions' );
        wp_register_script('infinite-scroll', get_bloginfo( 'template_directory' ).'/js/infinite-scroll.js','',false,true);
        wp_enqueue_script( 'infinite-scroll' );
     endif;
        //wp_register_script('carousel', get_bloginfo( 'template_directory' ).'/js/carousel.js','',false,true);
        //wp_enqueue_script( 'carousel' );
        //wp_register_script('tooltip', get_bloginfo( 'template_directory' ).'/js/tooltip.js','',false,true);
        //wp_enqueue_script( 'tooltip' );
        //wp_register_script('modal', get_bloginfo( 'template_directory' ).'/js/modal.js','',false,true);
        //wp_enqueue_script( 'modal' );
        wp_register_script('monjs', get_bloginfo( 'template_directory' ).'/js/monjs.js','',false,true);
        wp_enqueue_script( 'monjs' );
        wp_register_script('masonry4', get_bloginfo( 'template_directory' ).'/js/masonry.js','',false,true);
        wp_enqueue_script( 'masonry4' );
        wp_register_script('mymasonry', get_bloginfo( 'template_directory' ).'/js/my-masonry.js','',false,true);
        wp_enqueue_script( 'mymasonry' );
}

/*********** AJAX *********/

function add_js_scripts() {
	wp_enqueue_script( 'script', get_template_directory_uri().'/js/script.js', array('jquery'), '1.0', true );

	// pass Ajax Url to script.js
	wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action('wp_enqueue_scripts', 'add_js_scripts');

add_action( 'wp_ajax_la_video', 'la_video' );
add_action( 'wp_ajax_nopriv_la_video', 'la_video' );
function la_video(){
        //print_r($_POST['index'].' - '.$_POST['id']);
    if($_POST['index']){
        $index = $_POST['index'];
        $id = $_POST['id'];
        $cat = $_POST['cat'];
        //echo 'TEST - '.$index.' - '.$id.' - '.$cat;
        $interview = [
            'page_id' => $id,
            //'posts_per_page' => 1
        ];
        $query_interview = new WP_Query($interview);
        //print_r($query_interview);
        while($query_interview->have_posts()):$query_interview->the_post();
        //the_title();
        //print_r(have_rows($cat));
            while ( have_rows($cat) ) : the_row();
            if(get_row_index() == $index):
                echo '<div class="embed-responsive embed-responsive-16by9">';
                echo the_sub_field('video');
                echo '</div>';
                echo '<h3>';
                the_sub_field('titre');
                echo '</h3>';
                echo '<p>';
                the_sub_field('descriptif');
                echo '</p>';
            endif;endwhile;
        endwhile;
    }else{
        
    }
	die();
}

/******* PRESSE  /  EVENT ******/

function str_replace_assoc(array $replace, $subject) {
                return str_replace(array_keys($replace), array_values($replace), $subject);   
             }

             
/****** custom breadcrumbs ****/
             
add_filter( 'wpseo_breadcrumb_links', 'wpse_breadcrumb_disque' );

function wpse_breadcrumb_disque( $links ) {
    global $post;

    if ( is_singular( 'disque' ) ) {
        $breadcrumb[] = array(
            //'url' => get_permalink( get_option( 'page_for_posts' ) ),
            'url' => get_page_link(21585),
            'text' => get_the_title( 21585 ),
        );

        array_splice( $links, 1, -2, $breadcrumb );
    }
    if ( is_singular( 'presse' ) ) {
        $breadcrumb[] = array(
            //'url' => get_permalink( get_option( 'page_for_posts' ) ),
            'url' => get_page_link(22297),
            'text' => get_the_title( 22297 ),
        );

        array_splice( $links, 1, -2, $breadcrumb );
    }
    if ( is_singular( 'programme' ) ) {
        $breadcrumb[] = array(
            //'url' => get_permalink( get_option( 'page_for_posts' ) ),
            'url' => get_page_link(21233),
            'text' => get_the_title( 21233 ),
        );

        array_splice( $links, 1, -2, $breadcrumb );
    }

    return $links;
}

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
/*function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );*/

/****** TINYMCE ********/

function my_format_TinyMCE( $in ) {
	//$in['remove_linebreaks'] = false;
	//$in['gecko_spellcheck'] = false;
	//$in['keep_styles'] = true;
	//$in['accessibility_focus'] = true;
	//$in['tabfocus_elements'] = 'major-publishing-actions';
	//$in['media_strict'] = false;
	//$in['paste_remove_styles'] = false;
	//$in['paste_remove_spans'] = false;
	//$in['paste_strip_class_attributes'] = 'none';
	//$in['paste_text_use_dialog'] = true;
	//$in['wpeditimage_disable_captions'] = true;
	//$in['plugins'] = 'tabfocus,paste,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpfullscreen';
	//$in['content_css'] = get_template_directory_uri() . "/editor-style.css";
	//$in['wpautop'] = true;
	//$in['apply_source_formatting'] = false;
        $in['block_formats'] = "Paragraphe=p; Titre 1=h1; Titre 2=h2; Titre 3=h3; Titre 4=h4; Titre 5=h5; Titre 6=h6;";
	//$in['toolbar1'] = 'formatselect,small,bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv ';
	//$in['toolbar2'] = 'underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help ';
	//$in['toolbar3'] = 'forecolor';
	//$in['toolbar4'] = 'color';
        /*$style_formats = array (
        array( 'title' => 'Paragraphe', 'block' => 'p'),
        array( 'title' => 'Titre', 'block' => 'h2'),
        array( 'title' => 'Sous-titre', 'block' => 'h3'),
        array( 'title' => 'Tarif', 'inline' => 'span', 'classes' => 'tarif'),
        array( 'title' => 'Code', 'block' => 'pre', 'wrapper' => true),
        array( 'title' => 'Bouton', 'selector' => 'a', 'classes' => 'bouton' ),
        array( 'title' => 'Cadre', 'block' => 'div', 'wrapper' => true, 'classes' => 'cadre' )
        );
        $in['style_formats'] = json_encode( $style_formats );*/
	return $in;
}
add_filter( 'tiny_mce_before_init', 'my_format_TinyMCE' );
function my_mce4_options( $init ) {
/*$default_colours = '
"000000", "Black",
"993300", "Burnt orange",
"333300", "Dark olive",
"003300", "Dark green",
"003366", "Dark azure",
"000080", "Navy Blue",
"333399", "Indigo",
"333333", "Very dark gray",
"800000", "Maroon",
"FF6600", "Orange",
"808000", "Olive",
"008000", "Green",
"008080", "Teal",
"0000FF", "Blue",
"666699", "Grayish blue",
"808080", "Gray",
"FF0000", "Red",
"FF9900", "Amber",
"99CC00", "Yellow green",
"339966", "Sea green",
"33CCCC", "Turquoise",
"3366FF", "Royal blue",
"800080", "Purple",
"999999", "Medium gray",
"FF00FF", "Magenta",
"FFCC00", "Gold",
"FFFF00", "Yellow",
"00FF00", "Lime",
"00FFFF", "Aqua",
"00CCFF", "Sky blue",
"993366", "Brown",
"C0C0C0", "Silver",
"FF99CC", "Pink",
"FFCC99", "Peach",
"FFFF99", "Light yellow",
"CCFFCC", "Pale green",
"CCFFFF", "Pale cyan",
"99CCFF", "Light sky blue",
"CC99FF", "Plum",
"FFFFFF", "White"
';*/
/*"EC6BAB", "Violet",
"316998", "Bleu",*/
$custom_colours = '
"393939", "Gris 1",
"444444", "Gris 2",
"636363", "Girs 3",
"b2b2b2", "Gris 4",
"6a6a6a", "Gris 5",
"c7aa83", "Color logo",
"D6BB92", "Color logo survol",
"474f88", "Bleu titre",
"6a6c7e", "Bleu sous titre",
';
//$init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';
$init['textcolor_map'] = '['.$custom_colours.']';
$init['textcolor_rows'] = 6; // expand colour grid to 6 rows
return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');


/************* bar admin ****************/
function my_admin_bar_link() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
	'id' => 'banquetceleste',
	'parent' => 'site-name',
	'title' => __( 'Banquet Céleste'),
	'href' => admin_url( '/admin.php?page=banquetceleste' )
	) );
}
add_action('admin_bar_menu', 'my_admin_bar_link', 1000);
function mes_options(){
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
	'id' => 'accueil',
	'parent' => 'site-name',
	'title' => __( 'Options de la page d\'accueil'),
	'href' => admin_url( '/admin.php?page=acf-options-accueil' )
	) );
}
add_action('admin_bar_menu', 'mes_options', 1001);