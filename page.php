<?php get_header(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single_page'); ?>>
<?php if ( have_posts() ) : ?>
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
		<div class="page-header">
			<h1 class="page-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Enlace directo a %s'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h1>
			<?php
/*				if(has_post_thumbnail($post->ID)){
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
					$background='background: url('.$thumb['0'].') no-repeat center center fixed; 
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
					background-attachment: scroll;
					height:200px;';
					echo '<div class="col-xs-max" style="'.$background.'"></div>';
				}
*/
			?>
		</div>
		 <?php echo get_page_parents_list($post); ?> 
		<dl class="dl-horizontal">
			<dt>Autor Principal</dt>
			<dd><a href="#"><?php echo get_the_author_meta('display_name');?></a></dd>
			<dt>Creaci&oacute;n</dt>
			<dd><?php the_date('d/M/Y'); ?></dd>
			<dt>&Uacute;ltimo cambio</dt>
			<dd><?php the_modified_date('d/M/Y'); ?></dd>
		</dl>
		<hr/>
		<section class="page_content">
			<?php the_content(); ?>
		</section>
<?php endwhile;?>
<?php else:?>
	Esta p&aacute;gina no existe
<?php endif;?>
</article>
<?php get_footer(); ?>