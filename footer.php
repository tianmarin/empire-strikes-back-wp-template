<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	<footer id="main-footer" >
		<div class="container">
			<section class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<header>
					<p class="btn-circle btn-xl"><i class="fa fa-map-marker fa-fw " aria-hidden="true"></i></p>
					<h1 class="text-center">Noviscorp</h1>
				</header>
				<p class="text-justify">Somos una empresa l&iacute;der en el desarrollo de servicios World Class para todo el ciclo de vida de las soluciones SAP.</p>
				<a class="btn btn-danger" href="http://www.noviscorp.com" target="_blank">Conoce m&aacute;s de Novis</a>
			</section>
			<section class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<header>
					<p class="btn-circle btn-xl"><i class="fa fa-arrows-alt fa-fw " aria-hidden="true"></i></p>
					<h2 class="text-center">Accesos r&aacute;pidos</h2>
				</header>
				<div class="list-group">
					<a class="list-group-item" href="/">P&aacute;gina Principal</a>
					<a class="list-group-item" href="<?php echo admin_url( '', 'http' );?>">Ingreso a Administraci&oacute;n de Intranet</a>
					<a class="list-group-item" href="http://201.116.150.214/nagios/" target="_blank">Acceso a herramienta Nagios</a>
					<a class="list-group-item" href="http://soporte.noviscorp.com" target="_blank">SAP Solution Manager <strong>ITSM</strong></a>
				</div>
			</section>
			<section class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<header>
					<p class="btn-circle btn-xl"><i class="fa fa-book fa-fw " aria-hidden="true"></i></p>
					<h2 class="text-center">Intranet</h2>
				</header>
				<div class="list-group">
					<a class="list-group-item" href="#" target="_blank">Gu&iacute;a de Estilos y Documentaci&oacute;n</a>
					<a class="list-group-item" href="#" target="_blank">Mapa del Sitio</a>
				</div>
			</section>
		</div>
	</footer>
<?php wp_footer(); ?>
</body>
</html>