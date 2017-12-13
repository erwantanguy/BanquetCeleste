<?php
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );
//set_post_thumbnail_size( 50, 50, true );
set_post_thumbnail_size( 150, 150, array( 'center', 'center')  );
//wp_nav_menu( array( 'menu' => 'principal' ) );
add_theme_support( 'menus' );


/******** Mode maintenance *******/
// || !current_user_can('subscriber') || !current_user_can('administrator')
function maintenance_mode(){
	if(!is_user_logged_in()){
		//die('Nous sommes en maintenance !');
		$content = file_get_contents(TEMPLATEPATH.'/maintenance.php');
		die($content);
	}
}
if (get_option('maintenance')==='oui'){
	add_action('get_header', 'maintenance_mode');
}


function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

/******* extrait *******/

//the_excerpt_max_charlength(40);

function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
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
/******** SECURITE ***********/

remove_action("wp_head", "wp_generator");

function wpt_remove_version() {
	return ''; }
add_filter('the_generator', 'wpt_remove_version');

/******** ROBOTS.TXT *********/

function do_robots2() {

	header( 'Content-Type: text/plain; charset=utf-8' );

	do_action( 'do_robotstxt' );
	$output = "User-agent: *\n";
	$public = get_option( 'blog_public' );
	if ( '0' == $public ) {
		$output .= "Disallow: /\n";
	} else {
		$site_url = parse_url( site_url() );
		$path = ( !empty( $site_url['path'] ) ) ? $site_url['path'] : '';
		$output .= "Disallow: $path/wp-admin/\n";
		$output .= "Disallow: $path/wp-includes/\n";
		$output .= "Disallow: $path/wp-login.php\n";
		$output .= "Disallow: $path*/trackback\n";
	}

	echo apply_filters( 'robots_txt', $output, $public );
}

/******** SHORTCODES**********/

    if ( !is_admin() ) {
        add_filter('widget_text', 'do_shortcode', 11);
    }
 
 add_shortcode('bouton', 'mon_bouton');
 function mon_bouton($atts, $content = null) {
 	$a = shortcode_atts( array(
 			'link' => '',
 	), $atts );
 	return '<a class="btn btn-default" href="' . esc_attr($a['link']) . '" target="_blank">' . do_shortcode($content) . '</a>';
 };
 add_shortcode('lienF', 'lien_formulaire');
 function lien_formulaire($atts, $content = null){
 	$a = shortcode_atts( array(
 			'link' => '',
 	), $atts );
 	return '<a class="fancybox-inline btn btn-default" href="' . esc_attr($a['link']) . '">' . do_shortcode($content) . '</a>';
 };
 add_shortcode('formulaire','mon_formulaire');
 function mon_formulaire($atts, $content = null){
 	$a = shortcode_atts( array(
 			'id' => '',
 	), $atts );
 	return '<aside class="hidden"><div id="' . esc_attr($a['id']) . '" class="fancybox-inline">' . do_shortcode($content) . '</div></aside>';
 };


add_action('init', 'mylink_button');
function mylink_button() {
 
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
     return;
   }
 
   if ( get_user_option('rich_editing') == 'true' ) {
     add_filter( 'mce_external_plugins', 'add_plugin' );
     add_filter( 'mce_buttons', 'register_button' );
   }
 
}
function register_button( $buttons ) {
 //array_push( $buttons, "|", "englishversion" );
 array_push( $buttons, "|", "bouton" );
 array_push( $buttons, "|", "lienF" );
 array_push( $buttons, "|", "formulaire" );
 return $buttons;
}
function add_plugin( $plugin_array ) {
   //$plugin_array['englishversion'] = get_bloginfo( 'template_url' ) . '/js/mybuttons.js';
   $plugin_array['bouton'] = get_bloginfo( 'template_url' ) . '/js/mybuttons.js';
   $plugin_array['lienF'] = get_bloginfo( 'template_url' ) . '/js/mybuttons.js';
   $plugin_array['formulaire'] = get_bloginfo( 'template_url' ) . '/js/mybuttons.js';
   return $plugin_array;
}

/********** THEME ****************/
//add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
//add_theme_page('éléments supllémentaires', 'Options', 'edit_themes_options', 'options', array(10,'themeUi'));
function menu_options(){
	add_submenu_page("themes.php", "Options du thème", "Options du thème", 9, "options", "custom_theme_options");
}
function custom_theme_options(){
	//echo "<h2>Options du thème</h2>test et tout le reste";
	require_once ( get_template_directory() . '/theme-options.php' );
};
add_action("admin_menu", "menu_options");


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
  /*register_post_type( 'reference',
  array(
  'labels' => array(
  'name' => __( 'Références ' ),
  'singular_name' => __( 'Référence ' ),
  'all_items' => 'Toutes les références',
  'add_new_item' => 'Ajouter une référence',
  'edit_item' => 'Éditer la référence',
  'new_item' => 'Nouvelle référence',
  'view_item' => 'Voir la référence',
  'search_items' => 'Rechercher parmi les références',
  'not_found' => 'Pas de référence trouvée',
  'not_found_in_trash'=> 'Pas de référence dans la corbeille'
  		),
  		'public' => true,
  		'supports'=>array('title','editor','thumbnail','excerpt','revisions'),
  		'query_var' => true,
  		'rewrite' => true,
  		'capability_type' => 'post',
  )
  );*/
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
  //register_taxonomy('refenrece','archive',array( 'hierarchical' => false, 'label' => 'Références', 'query_var' => true, 'rewrite' => array( 'slug' => 'reference' ) ));
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
	'default-image' => 'http://www.ticoet.fr/drmgalerie/wp-content/uploads/sites/12/2015/09/bandeau_defaut.png', //get_template_directory_uri() . 
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
add_image_size('slider',1170,500,array( 'center', 'center' ));
add_image_size('box',2000);

//update_option('image_default_link_type','post');
//update_option('image_default_link_type','none');
//update_option('image_default_link_type','file');
//update_option('image_default_size', 'box' );

/*function large_attachment_fields_to_edit($fields, $post){
	if (substr($post->post_mime_type,0,5) == 'image'){
		$html = "<input type='text' class='text urlfield' name='attachments[$post->ID][url]'value='".esc_attr(array_shift( wp_get_attachment_image_src($post->ID, 'large', false) ))."' /><br /><button type='button' class='button urlnone' title=''>" . __('None') . "</button><button type='button' class='button urlfile'title='".esc_attr(array_shift( wp_get_attachment_image_src($post->ID, 'large', false) ))."'>Large File URL</button>                                <button type='button' class='button urlfile' title='" . esc_attr(wp_get_attachment_url($post->ID)) . "'>" . __('Original File URL') . "</button><button type='button' class='button urlpost' title='" . esc_attr(get_attachment_link($post->ID)) . "'>" . __('Post URL') . "</button>";
		$fields['url']['html'] = $html;
   }
   return $fields;
}
add_filter('attachment_fields_to_edit',  'large_attachment_fields_to_edit', 0,  2);*/

function oikos_get_attachment_link_filter( $content, $post_id, $size, $permalink ) {
 
    // Only do this if we're getting the file URL
    if (! $permalink) {
        // This returns an array of (url, width, height)
        $image = wp_get_attachment_image_src( $post_id, 'box' );
        $new_content = preg_replace('/href=\'(.*?)\'/', 'href=\'' . $image[0] . '\'', $content );
        return $new_content;
    } else {
        return $content;
    }
}
 
add_filter('wp_get_attachment_link', 'oikos_get_attachment_link_filter', 10, 4);
/***********colonnes perso *******/

// Création des colonnnes personnalisées

// Affichage des données
add_action('manage_posts_custom_column', 'data_colonne');
function data_colonne($name) {
 global $post;
 switch ($name) {
case 'thumb':
 if(has_post_thumbnail($post->ID))
 {
 ?>
 <a href="<?php the_permalink(); ?>" target="_blank">
 <?php the_post_thumbnail(array(70,70));?>
 </a>
 <?php
 }
 else
 {
 _e('Pas d\'image','twentyeleven');
 }
 break;
 }
 }







function my_page_columns($columns)
{
	$columns = array(
		'cb'	 	=> '<input type="checkbox" />',
		'thumb' => __('Miniature'),
		'title' 	=> 'Title',
		'accueil' 	=> 'Accueil',
		'author'	=>	'Author',
		'date'		=>	'Date',
	);
	return $columns;
}

function my_custom_columns($column)
{
	global $post;
	if($column == 'accueil')
	{
		//print_r(get_field('accueil', $post->ID, false));
		if(get_field('accueil', $post->ID))
		{
			echo 'Oui';
		}
		else
		{
			echo 'Non';echo get_field('accueil', $post->ID);
		}
	}
}

add_action("manage_oeuvre_posts_custom_column", "my_custom_columns");
add_filter("manage_edit-oeuvre_columns", "my_page_columns");

function my_column_register_sortable( $columns )
{
	$columns['accueil'] = 'accueil';
	return $columns;
}

add_filter("manage_edit-post_sortable_columns", "my_column_register_sortable" );


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
}
/***************** EVENTS ******************/


/*function tribe_link_next_class($format){
$format = str_replace('href=', 'class="btn btn-default" href=', $format);
return $format;
}
add_filter('tribe_the_next_event_link', 'tribe_link_next_class');

function tribe_link_prev_class($format) {
$format = str_replace('href=', 'class="btn btn-default" href=', $format);
return $format;
}
add_filter('tribe_the_prev_event_link', 'tribe_link_prev_class');*/



/************************* META BOXES ************************/

/*add_action('add_meta_boxes','init_metabox');
function init_metabox(){
  add_meta_box('homepage', 'Accueil', 'home_page', 'oeuvre', 'side');
}

function home_page($post){
  $dispo = get_post_meta($post->ID,'_home_page',true);
  echo '<label for="home_page_meta">Mise en avant de l\'oeuvre sur la page d\'accueil :</label>';
  echo '<select name="home_page">';
  echo '<option ' . selected( 'oui', $dispo, false ) . ' value="oui">Oui</option>';
  echo '<option ' . selected( 'non', $dispo, false ) . ' value="non">Non</option>';
  echo '</select>';

}

add_action('save_post','save_metabox');
function save_metabox($post_id){
if(isset($_POST['home_page']))
  update_post_meta($post_id, '_home_page', $_POST['home_page']);
}*/


/**************************** JS *****************************/
    add_action('init', 'gkp_insert_js_in_footer');
    function gkp_insert_js_in_footer() {
     
    // On verifie si on est pas dans l'admin
    if( !is_admin() ) :
     
        // On annule jQuery installer par WordPress (version 1.4.4
        wp_deregister_script( 'jquery' );
     
        // On declare un nouveau jQuery dernière version grace au CDN de Google https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js
        wp_register_script( 'jquery', get_bloginfo( 'template_directory' ).'/js/jquery.min.js','',false,true);
        wp_enqueue_script( 'jquery' );
     
        // On insere le fichier de ses propres fonctions javascript
        wp_register_script('functions', get_bloginfo( 'template_directory' ).'/js/bootstrap.min.js','',false,true);
		wp_enqueue_script( 'functions' );
		wp_register_script('docs', get_bloginfo( 'template_directory' ).'/js/docs.min.js','',false,true);
		wp_enqueue_script( 'docs' );
		wp_register_script('collapse', get_bloginfo( 'template_directory' ).'/js/collapse.js','',false,true);
		wp_enqueue_script( 'collapse' );
		wp_register_script('carousel', get_bloginfo( 'template_directory' ).'/js/carousel.js','',false,true);
        wp_enqueue_script( 'carousel' );
		wp_register_script('tab', get_bloginfo( 'template_directory' ).'/js/tab.js','',false,true);
        wp_enqueue_script( 'tab' );
        wp_register_script('tooltip', get_bloginfo( 'template_directory' ).'/js/tooltip.js','',false,true);
        wp_enqueue_script( 'tooltip' );
        //wp_register_script('monjs', get_bloginfo( 'template_directory' ).'/js/monjs.js','',false,true);
        wp_enqueue_script( 'monjs' );
		/*wp_register_script('css', 'http://etherpad.com/ouestlab/schad/style.css','',false,true);
        wp_enqueue_script( 'css' );*/
		wp_register_script('masonry', get_bloginfo( 'template_directory' ).'/js/masonry.js','',false,true);
        wp_enqueue_script( 'masonry' );
		wp_register_script('myMasonry', get_bloginfo( 'template_directory' ).'/js/my-masonry.js','',false,true);
        wp_enqueue_script( 'myMasonry' );
    endif;
    }

    /******************** AJAX ***************/
    
    function add_js_scripts() {
    	wp_enqueue_script( 'script', get_template_directory_uri().'/js/ajax.js', array('jquery'), '1.0', true );
    
    	// pass Ajax Url to script.js
    	wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
    }
    add_action('wp_enqueue_scripts', 'add_js_scripts');
    
    
    add_action( 'wp_ajax_mon_action', 'mon_action' );
    add_action( 'wp_ajax_nopriv_mon_action', 'mon_action' );


    function mon_action(){
    	$post = $_POST['param'];
    	//print_r($post);
    	if($post){
    	$args = array(
			'post_type'		=> 'realisation',
			'posts_per_page' => -1,
			'orderby' => 'date',
			'order'   => 'DESC',
                        'post_status' => 'publish',
			'tax_query' => array(
					//'relation' => 'AND',
					array(
							'taxonomy' => 'categorie',
							//'field' => 'term_id',
							//'terms' => $lieu,
							'field' => 'slug',
							'terms' => $post,
					),
					/*array(
					 'taxonomy' => 'referece',
							'field' => 'slug',
							'terms' => $post,
					)*/
			),
                        'meta_query' => array(
                                         'relation' => 'OR',
                                         array(
                                             'key' => 'archive',
                                             'value' => '',
                                             'compare' => 'NOT EXISTS',
                                         ),
                                         /*array(
                                             'key' => 'archive',
                                             'value' => false,
                                             //'compare' => 'NOT EXISTS',
                                         ),*/
                                         array(
                                             'key' => 'archive',
                                             'value' => true,
                                             'compare' => 'NOT IN',
                                         ),
                                     ),
    	);}else{
			$args = array(
				'post_type'		=> 'realisation',
				'posts_per_page' => -1,
				'orderby' => 'date',
				'order'   => 'DESC',
                                'post_status' => 'publish',
                                'meta_query' => array(
                                            'relation' => 'OR',
                                            array(
                                                'key' => 'archive',
                                                'value' => '',
                                                'compare' => 'NOT EXISTS',
                                            ),
                                            /*array(
                                                'key' => 'archive',
                                                'value' => false,
                                                //'compare' => 'NOT EXISTS',
                                            ),*/
                                            array(
                                                'key' => 'archive',
                                                'value' => true,
                                                'compare' => 'NOT IN',
                                            ),
                                        ),
			);
		}
		//print_r($args);
	  	$ajax_query = new WP_Query($args);
	  	if ( $ajax_query->have_posts() ) : 
	  		while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
	  			include(locate_template('oeuvre-ajax.php'));
		  	endwhile;
                else:
                echo "<h4 class=\"text-center\">Il n'y a pas de résultat pour l'instant.</h4>";
	  	endif;
	  	wp_reset_postdata();
	  	die();
    }
    
    add_action( 'wp_ajax_mon_action2', 'mon_action2' );
    add_action( 'wp_ajax_nopriv_mon_action2', 'mon_action2' );


    function mon_action2(){
    	$post = $_POST['param'];
    	//print_r($post);
    	if($post){
    	$args = array(
			'post_type'		=> 'realisation',
			'posts_per_page' => -1,
			'orderby' => 'date',
			'order'   => 'DESC',
                        'post_status' => 'publish',
			'tax_query' => array(
					//'relation' => 'AND',
					array(
							'taxonomy' => 'categorie',
							//'field' => 'term_id',
							//'terms' => $lieu,
							'field' => 'slug',
							'terms' => $post,
					),
					/*array(
					 'taxonomy' => 'referece',
							'field' => 'slug',
							'terms' => $post,
					)*/
			),
                        'meta_query' => array(
                                    array(
                                        'key' => 'archive',
                                        'value' => true,
                                    ),
                                 ),
    	);}else{
			$args = array(
				'post_type' => 'realisation',
                                'posts_per_page' => -1,
				'orderby' => 'date',
				'order'   => 'DESC',
                                'meta_query' => array(
                                    array(
                                        'key' => 'archive',
                                        'value' => true,
                                    ),
                                 ),
			);
		}
		//print_r($args);
	  	$ajax_query = new WP_Query($args);
	  	if ( $ajax_query->have_posts() ) : 
	  		while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
	  			include(locate_template('oeuvre-ajax.php'));
		  	endwhile;
                else:
                echo "<h4 class=\"text-center\">Il n'y a pas de résultat pour l'instant.</h4>";
	  	endif;
	  	wp_reset_postdata();
	  	die();
    }
    
    
    add_action( 'wp_ajax_mes_references', 'mes_references' );
    add_action( 'wp_ajax_nopriv_mes_references', 'mes_references' );
    
    function mes_references(){
    	$post = $_POST['param'];
    	//print_r($post);
    	if($post){
    		$args = array(
    				'post_type'		=> 'reference',
    				'posts_per_page' => -1,
    				'orderby' => 'date',
    				'order'   => 'DESC',
    				'tax_query' => array(
    						//'relation' => 'AND',
    						array(
    								'taxonomy' => 'category',
    								//'field' => 'term_id',
    								//'terms' => $lieu,
    								'field' => 'slug',
    								'terms' => $post,
    						),
    						/*array(
    						 'taxonomy' => 'referece',
    								'field' => 'slug',
    								'terms' => $post,
    						)*/
    				),
    		);}
                else{
    			$args = array(
    					'post_type'		=> 'reference',
    					'posts_per_page' => -1,
    					'orderby' => 'date',
    					'order'   => 'DESC',
    			);
    		}
    		//print_r($args);
    		$ajax_query = new WP_Query($args);
    		if ( $ajax_query->have_posts() ) :
    		while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
    		include(locate_template('references-ajax.php'));
    		endwhile;
                else:
                echo "<h4 class=\"text-center\">Il n'y a pas de résultat pour l'instant.</h4>";
    		endif;
    		wp_reset_postdata();
    		die();
    }
    
    add_action( 'wp_ajax_mes_categories', 'mes_categories' );
    add_action( 'wp_ajax_nopriv_mes_categories', 'mes_categories' );
    
    function mes_categories(){
    	$post = $_POST['param'];
    	$lieu = $_POST['catname'];
    	//$lieu = $wp_query->get_queried_object()->term_id;
    	//print_r($post." - ".$lieu."<hr>");
    	//print_r($lieu);
    	if($post){
    		$args = array(
    				'post_type'		=> 'realisation',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order'   => 'ASC',
					'tax_query' => array(
						'relation' => 'AND',
							array(
									'taxonomy' => 'categorie',
									'field' => 'term_id',
									'terms' => $lieu,
							),
							array(
								'taxonomy' => 'referece',
								'field' => 'slug',
								'terms' => $post,
							)
    				),
    			);
    		}else{
    			$args = array(
    					'post_type'		=> 'realisation',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order'   => 'ASC',
						'tax_query' => array(
							array(
									'taxonomy' => 'categorie',
									'field' => 'term_id',
									'terms' => $lieu,
							)
						),
    			);
    		}
    		/*
    		{
				$my_query2 = new WP_Query(array(
					'post_type'		=> 'realisation',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order'   => 'ASC',
					'tax_query' => array(
						'relation' => 'AND',
							array(
									'taxonomy' => 'categorie',
									'field' => 'term_id',
									'terms' => $lieu,
							),
							array(
								'taxonomy' => 'referece',
								'field' => 'slug',
								'terms' => $post,
							)
						),
					//'tag_slug__in' => $post,
				));
			}else
    		 */
    		//print_r($args);
    		$ajax_query = new WP_Query($args);
    		//print_r($ajax_query);
    		if ( $ajax_query->have_posts() ) :
    		//while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
    		//print_r($ajax_query);
    		include(locate_template('slider-tax-real.php'));
    		//endwhile;
    		else:
    		echo "<h4 class=\"text-center\">Il n'y a pas de résultat pour l'instant.</h4>";
    		endif;
    		//wp_reset_postdata();
    		die();
    }
    
    
    add_action( 'wp_ajax_structures', 'structures' );
    add_action( 'wp_ajax_nopriv_structures', 'structures' );
    
    function structures(){
    	$post2 = $_POST['param'];
    	//print_r($post2);
    	if($post2){
    		$args = get_terms( array(
                    'taxonomy' => 'tagexpo',
					'hide_empty' => 0,
                    //'meta_key' => 'strutures',
                    //'meta_value' => $post2,
                    /*'meta_query' => array(
                        array(
                           'key'       => 'strutures',
                           'value'     => $post2,
                           //'compare'   => '='
                        )
                   )*/
                    ) );
    		}else{
    			$args = get_terms( array(
                    'taxonomy' => 'tagexpo',
					'hide_empty' => 0,
                    //'meta_key' => 'structures',
                    //'meta_value' => $post,
                    /*'meta_query' => array(
                        array(
                           'key'       => 'structures',
                           'value'     => $post,
                           'compare'   => '='
                        )
                   )*/
                    ) );
    		}
    		//print_r($args);
    		$ajax_query = new WP_Query($args);
    		//print_r($ajax_query);
    		if ( $ajax_query->have_posts() ) :
    		//while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
    		//print_r($ajax_query);
    		include(locate_template('cadres-references.php'));
    		//endwhile;
    		else:
    		echo "<h4 class=\"text-center\">Il n'y a pas de résultat pour l'instant.</h4>";
    		endif;
    		//wp_reset_postdata();
    		die();
    }
    


/********************* ical **************/

// Changes the text labels for Google Calendar and iCal buttons on a single event page
remove_action('tribe_events_single_event_after_the_content', array('Tribe__Events__iCal', 'single_event_links'));
add_action('tribe_events_single_event_after_the_content', 'customized_tribe_single_event_links');
  
function customized_tribe_single_event_links()    {
    if (is_single() && post_password_required()) {
        return;
    }
  
    echo '<div class="tribe-events-cal-links">';
    echo '<a class="btn btn-default btn-xs" href="' . tribe_get_gcal_link() . '" title="' . __( 'Add to Google Calendar', 'tribe-events-calendar-pro' ) . '">Google Agenda</a>';
    echo ' <a class="btn btn-default btn-xs" href="' . tribe_get_single_ical_link() . '">Exporter vers iCal</a>';
    echo '</div><!-- .tribe-events-cal-links -->';
}

//+ Google Agenda+ Exporter vers iCal
add_action('event_calendar', 'customized_tribe_single_event_links2');

function customized_tribe_single_event_links2()    {
	if (is_single() && post_password_required()) {
		return;
	}

	//echo '<ul class="nav navbar-nav">';
	//echo '<li><a class="share" href="' . tribe_get_gcal_link() . '" title="' . __( 'Ajouter à Google Calendar', 'tribe-events-calendar-pro' ) . '"><i class="fa fa-calendar-plus-o"></i></a></li>';
	//echo '<li><a class="share" href="' . tribe_get_single_ical_link() . '" title="Exporter vers iCal"><i class="fa fa-calendar"></i></a></li>';
	//echo '</ul>';
	echo '<a class="share" href="' . tribe_get_gcal_link() . '" title="' . __( 'Ajouter à Google Calendar', 'tribe-events-calendar-pro' ) . '"><i class="fa fa-calendar-plus-o"></i></a> ';
	echo '<a class="share" href="' . tribe_get_single_ical_link() . '" title="Exporter vers iCal"><i class="fa fa-calendar"></i></a>';
	//echo '<a class="share" href="' . tribe_get_single_ical_link() . '" title="Exporter vers iCal"><i class="fa fa-calendar"></i></a>'';
}


/************* ROLES ****************/

/*
Objectif : Permettre à toutes les personnes du role "Editeur" de pouvoir manipuler le menu de son site Internet
            - Etape 1 : Ajouter au role Editeur l'accès à l'Apparence du site
            - Etape 2 : Retirer tous les sous menu du menu "Apparence" saus le sous menu "Menus"
*/
$roleObject = get_role( 'editor' );
if (!$roleObject->has_cap( 'edit_theme_options' ) ) {
    $roleObject->add_cap( 'edit_theme_options' );
}
 
function hide_menu() {
    // Si le role de l'utilisatieur ne lui permet pas d'ajouter des comptes (autrement dit si il n'est pas admin)
    if(!current_user_can('add_users')) {
      remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
      //remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the widgets submenu
      remove_submenu_page( 'themes.php', 'theme-editor.php' ); // hide the editor menu
 
      // Le code suisant c'est juste poure retirer le sous menu "Personnaliser"
      $customize_url_arr = array();
      $customize_url_arr[] = 'customize.php'; // 3.x
      $customize_url = add_query_arg( 'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'customize.php' );
      $customize_url_arr[] = $customize_url; // 4.0 & 4.1
      if ( current_theme_supports( 'custom-header' ) && current_user_can( 'customize') ) {
          $customize_url_arr[] = add_query_arg( 'autofocus[control]', 'header_image', $customize_url ); // 4.1
          $customize_url_arr[] = 'custom-header'; // 4.0
      }
      if ( current_theme_supports( 'custom-background' ) && current_user_can( 'customize') ) {
          $customize_url_arr[] = add_query_arg( 'autofocus[control]', 'background_image', $customize_url ); // 4.1
          $customize_url_arr[] = 'custom-background'; // 4.0
      }
      foreach ( $customize_url_arr as $customize_url ) {
          remove_submenu_page( 'themes.php', $customize_url );
      }
 
    }
 
}
add_action('admin_head', 'hide_menu');

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
	'id' => 'diww',
	'parent' => 'site-name',
	'title' => __( 'Mes options'),
	'href' => admin_url( '/themes.php?page=options' )
	) );
}
add_action('admin_bar_menu', 'mes_options', 999);

function les_oeuvres() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
	'id' => 'realisation',
	'parent' => 'site-name',
	'title' => __( 'Les réalisations'),
	'href' => admin_url( '/edit.php?post_type=realisation' )
	) );
}
add_action('admin_bar_menu', 'les_oeuvres', 1001);

/********** FLUX RSS IMAGES *****************/

function wpc_rss_miniature($excerpt) {
global $post;

$content = '<p>' . get_the_post_thumbnail($post->ID) .
'</p>' . get_the_excerpt();

return $content;
}
add_filter('the_excerpt_rss', 'wpc_rss_miniature');
add_filter('the_content_feed', 'wpc_rss_miniature');


?>