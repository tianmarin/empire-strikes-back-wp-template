<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-sm-4 hidden-xs">
			<img src="<?php echo get_template_directory_uri();?>/img/404.gif" height="100%" width="auto"/>
		</div>
		<div class="col-xs-12 col-sm-8">
			<div class="error-template text-center">
				<h1>&iexcl;Oops!</h1>
				<h2>P&aacute;gina no encontrada</h2>
				<div class="error-details">
					<p class="lead">Lo sentimos, ha ocurrido un error inesperado<br/>La p&aacute;gina que buscas no existe.</p>
				</div>
				<div class="error-actions">
					<a href="<?php echo esc_url( home_url( '/' ));?>" class="btn btn-danger btn-lg "><i class="fa fa-home fa-fw"></i> Vamos al inicio </a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>