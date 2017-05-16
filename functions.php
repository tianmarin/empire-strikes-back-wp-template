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


//http://codex.wordpress.org/Function_Reference/remove_menu_page
function remove_menus(){
//	remove_menu_page( 'upload.php' );                 //Media
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
		$relations=array_reverse($relations);
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


add_shortcode( 'duplicar', 'replicate_page' );

function replicate_page($atts,$url="") {
	$pageid = url_to_postid($url);
//	$page = get_page_by_path($path);
	$page = get_page($pageid);
	$content = apply_filters('the_content', $page->post_content);
	return $content;
}




// init process for registering our button
add_action('admin_init', 'esb_subpages_shortcode_button_init');
function esb_subpages_shortcode_button_init() {
	//Abort early if the user will never see TinyMCE
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
	return;

	//Add a callback to regiser our tinymce plugin
	add_filter("mce_external_plugins", "esb_subpages_register_tinymce_plugin");

	// Add a callback to add our button to the TinyMCE toolbar
	add_filter('mce_buttons', 'esb_subpages_add_tinymce_button');
}


//This callback registers our plug-in
function esb_subpages_register_tinymce_plugin($plugin_array) {
	$plugin_array['esb_subpages_button'] = get_stylesheet_directory_uri().'/js/shortcode_btn.js';
	return $plugin_array;
}

//This callback adds our button to the toolbar
function esb_subpages_add_tinymce_button($buttons) {
	//Add the button ID to the $button array
	$buttons[] = "esb_subpages_button";
	return $buttons;
}




add_shortcode( "subpages", 'esb_subpages_shortcode' );
function esb_subpages_shortcode($atts){
	$id = get_the_ID();
	$page=get_post($id);
	$output='';
	$output .='<section class="row well">';
	$output .='<span class="h3">';
	$output .="Subp&aacute;ginas de ".$page->post_title;
	$output .='</span>';
	$output .='<div class="list-group">';
	$subargs = array(
		'sort_order'	=> 'ASC',
		'sort_column'	=> 'menu_order',
		'hierarchical'	=> 1,
		'exclude'		=> '',
		'include'		=> '',
		'meta_key'		=> '',
		'meta_value'	=> '',
		'authors'		=> '',
		'child_of'		=> 0,
		'parent'		=> $page->ID,
		'exclude_tree'	=> '',
		'number'		=> '',
		'offset'		=> 0,
		'post_type'		=> 'page',
		'post_status'	=> 'publish'
		);
		$subpages = get_pages($subargs);

		foreach($subpages as $subpage):
			$output .='<a class="list-group-item" href="'.get_page_link($subpage->ID).'">';
			$output .='<span class="h5 list-group-item-heading">'.$subpage->post_title.'</span>';
			$output .='<p class="list-group-item-text">'.$subpage->post_excerpt.'</p>';
			$output .='</a>';
		endforeach;
	$output .='</div>';
	$output .='</section>';
	return $output;

}








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


function tesb_customize_register( $wp_customize ) {
	//All our sections, settings, and controls will be added here
	$wp_customize->add_setting( 'front_page_learn_more_link' , array(
		'default'   => home_url(),
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( 'front_page_learn_more_link', array(
		'label'			=> __( 'Link de P&aacute;gina inicial', 'tesb' ),
		'type'			=> 'text',
		'description'	=> 'Define the Learn More Link at the HomePage Template',
		'section'		=> 'static_front_page',
		'settings'		=> 'front_page_learn_more_link',
	) );


}
add_action( 'customize_register', 'tesb_customize_register' );

?>
