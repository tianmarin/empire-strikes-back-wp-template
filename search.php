<?php get_header();	
	wp_register_script("search_open",get_template_directory_uri().'/js/search_open.js',"search_accordion");
	wp_enqueue_script("search_open");

?>
<article id="search">
	<h1>
		B&uacute;squeda de: <span><?php echo $_GET['s'];?></span>
	</h1>
	<section class="results">
		<?php if ( have_posts() && $post_type!="post") : ?>
			<ul>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<li>
						<span class="parents"><?php echo strip_tags(get_page_parents_list($post),"<ul><li>"); ?></span>
						<a class="link"	href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>
						<span class="excerpt"><?php  echo the_excerpt_max_charlength(400); ?></span>
					</li>
				<?php endwhile;?>
			</ul>
			<!-- Add the pagination functions here. -->
			<?php wp_pagenavi(); ?>

		<?php else:?>
			<span class="not_found">Lo sentimos, no hay publicaciones que coincidan tu criterio de b&uacute;squeda.<br/>
				<?php if($post_type!="post"):?>
				<?php endif;?>
			</span>
		<?php endif;?>
	</section>
</article>
<?php get_footer(); ?>