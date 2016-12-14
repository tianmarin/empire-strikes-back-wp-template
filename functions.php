<?php



add_theme_support( 'post-thumbnails' );
/* http://www.wpbeginner.com/plugins/add-excerpts-to-your-pages-in-wordpress/*/
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
/* http://codex.wordpress.org/Function_Reference/add_editor_style */
function my_theme_add_editor_styles() {
	add_editor_style( 'style.css' );
}
add_action( 'admin_init', 'my_theme_add_editor_styles' );

/*http://wordpress.org/support/topic/change-width-of-visual-editor-in-fullscreen-mode*/
set_user_setting( 'dfw_width', 1200 );


/*http://wordpress.org/support/topic/how-can-i-force-https-on-everything*/
/*
function my_force_ssl() {
    return true;
}
add_filter('force_ssl', 'my_force_ssl', 10, 3);
*/

//http://codex.wordpress.org/Function_Reference/remove_menu_page
function remove_menus(){
	remove_menu_page( 'upload.php' );                 //Media  
    remove_menu_page('edit.php');                     //Posts  
}
add_action( 'admin_menu', 'remove_menus' );
/*
* 
* ------------------------------------------------------------------------------------------------------
*/
function get_page_parents_list($post=''){
	global $wpdb;
	if($post->post_parent){
		//collect ancestor pages
		$relations = get_post_ancestors($post->ID);
		//add current post to pages
		array_push($relations, $post->ID);
		//get comma delimited list of children and parents and self
		$relations_string = implode(",",$relations);
		$output='';
		foreach($relations as $page){
			$output .= wp_list_pages("title_li=&echo=0&include=".$page);
		}
		$output = str_replace("current_page_item", "current_page_item active", $output);
		//use include to list only the collected pages. 
//		$output = wp_list_pages("title_li=&echo=0&include=".$relations_string);
	}
	if (isset($output)) {
		$o = '<ul class="breadcrumb"">';
		$o.= $output;
		$o.= "</ul>";
		return $o;
	}
}

/*
* Agregar contenido a the_content
* http://wordpress.org/support/topic/add-something-to-the_content
* ------------------------------------------------------------------------------------------------------
*/
function auto_vd_content($content) {
	global $post;
	$original = $content;
	$content = "[auto_vd]";
	$content .= $original;
	return $content;
}
//add_filter( 'the_content', 'auto_vd_content' );


/*
* Eliminar Page_Template para usuarios NO Admin
* http://wordpress.org/support/topic/limit-page-templates-based-on-user-roles
* http://wp-snppts.com/removing-meta-boxes-from-editor-screen
* ------------------------------------------------------------------------------------------------------
*/
function remove_page_fields() {
	if ( ! current_user_can('manage_options') ){
		remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' ); // allow comments for pages
		remove_meta_box( 'commentsdiv' , 'page' , 'normal' ); // recent comments for pages
		remove_meta_box( 'postcustom' , 'page' , 'normal' ); // custom fields for pages
		remove_meta_box('slugdiv','page','normal'); // page slug
	}
}
add_action( 'admin_menu', 'remove_page_fields' );


/*
* Short Exceprt
* http://codex.wordpress.org/Function_Reference/get_the_excerpt
*/

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


/**
 * WordPress register with email only, make it possible to register with email 
 * as username in a multisite installation
 * @param  Array $result Result array of the wpmu_validate_user_signup-function
 * @return Array         Altered result array
 */
function custom_register_with_email($result) {
 
   if ( $result['user_name'] != '' ) {
 
      unset( $result['errors']->errors['user_name'] );
      unset( $result['errors']);
 
   }
   return $result;
}
add_filter('wpmu_validate_user_signup','custom_register_with_email');
 
/**
* Login Template
* http://premium.wpmudev.org/blog/create-a-custom-wordpress-login-page/
*/
function custom_login_css() {

    wp_enqueue_style( 'custom-login',  get_stylesheet_directory_uri().'/login/login-style.css' );
}
add_action('login_head', 'custom_login_css');











/**
* Insert custom styles in TinyMCE
* http://premium.wpmudev.org/blog/create-a-custom-wordpress-login-page/
*/
// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

function my_mce_before_init( $init_array ) {
	$init_array['theme_advanced_buttons2_add'] = 'styleselect';
	$init_array['theme_advanced_styles'] = 'Novis_123';
 
	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );







?>
