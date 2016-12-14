<?php
/*
* Template Name: HomePage
*/
get_header();
?>
<?php if ( have_posts() ) : ?>
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	$jumbotron_style='background: url('.$thumb['0'].') no-repeat center center fixed; 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;'
	
?>
<div class="jumbotron" style="<?php echo $jumbotron_style;?>">
	<div class="container">
		<h1>¡Bienvenido!</h1>
		<p>La intranet de <strong><?php echo bloginfo( 'name' ) ?></strong> ha sido redise&ntilde;ada para una mejor experiencia.</p>
		<p><a class="btn btn-danger btn-lg" href="#" role="button">Aprende m&aacute;s</a></p>
	</div>
</div>
<article id="inicio" class="container">
	<?php
	$args = array(
		'sort_order'	=> 'ASC',
		'sort_column'	=> 'menu_order',
		'hierarchical'	=> 1,
		'exclude'		=> '',
		'include'		=> '',
		'meta_key'		=> '',
		'meta_value'	=> '',
		'authors'		=> '',
		'child_of'		=> 0,
		'parent'		=> 0,
		'exclude_tree'	=> '',
		'number'		=> '',
		'offset'		=> 0,
		'post_type'		=> 'page',
		'post_status'	=> 'publish'
		); 
		$pages = get_pages($args);
		foreach($pages as $page):
			$output .='<section>';
			$output .='<h1>';
			$output .=$page->post_title;
			$output .='</h1>';
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
					$output .='<a class="col-xs-12 col-sm-6 col-md-4 col-lg-3 list-group-item" href="'.get_page_link($subpage->ID).'">';
					$output .='<h4 class="list-group-item-heading">'.$subpage->post_title.'</h4>';
					$output .='<p class="list-group-item-text">'.$subpage->post_excerpt.'</p>';
					$output .='</a>';
				endforeach;
			$output .='</div>';
			$output .='</section>';
		endforeach;
		echo $output;

	?>
</article><!-- FIN #inicio -->
<?php endwhile;?>
<?php else:?>
	Esta p&aacute;gina no existe
<?php endif;?>

<?php get_footer(); ?>
