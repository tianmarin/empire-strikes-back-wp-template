<?php
/*
* Template Name: HomePage Novis
*/
get_header(); ?>
<article id="sites">
	<?php
		$args = array(
			'network_id'	=> $wpdb->siteid,
			'public'    	=> 1,
			'archived'  	=> null,
			'mature'    	=> null,
			'spam'      	=> null,
			'deleted'   	=> null,
			'limit'     	=> 100,
			'offset'    	=> 1,
		); 
		$sites = wp_get_sites($args);


		foreach ( $sites as $i => $site ) {
			switch_to_blog( $site[ 'blog_id' ] );
			$sites[ $i ][ 'name' ] = get_bloginfo();
			restore_current_blog();
		}
		uasort( $sites, function( $site_a, $site_b ) {
			return strcasecmp( $site_a[ 'name' ], $site_b[ 'name' ] );
		});



		echo "<section>";
		echo "Sitios M&eacute;xico";
		echo "<ul>";
		foreach($sites as $site):
			$blog = get_blog_details($site['blog_id']);
			echo "<li class='site'>";
				echo "<a href='".$blog->siteurl."'>".$blog->blogname."</a>";
			echo "</li>";
		endforeach;
		echo "</ul></section>";
	?>
</article><!-- FIN #sites -->

<!--
<article id="inicio">
	<?php
	$args = array(
		'sort_order' => 'ASC',
		'sort_column' => 'menu_order',
		'hierarchical' => 1,
		'exclude' => '',
		'include' => '',
		'meta_key' => '',
		'meta_value' => '',
		'authors' => '',
		'child_of' => 0,
		'parent' => 0,
		'exclude_tree' => '',
		'number' => '',
		'offset' => 0,
		'post_type' => 'page',
		'post_status' => 'publish'
		); 
		$pages = get_pages($args);
//		foreach($pages as $page):
//			echo "<section><ul>";
//			list_home_pages($page);
//			echo "</ul></section>";
//		endforeach;
	?>
</article>
-->
<!-- FIN #inicio -->

<?php get_footer(); ?>
