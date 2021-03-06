<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		?>
	</title>
<?php
	function address_mobile_address_bar() {
		$color = "#C21515";
		//this is for Chrome, Firefox OS, Opera and Vivaldi
		echo '<meta name="theme-color" content="'.$color.'">';
		//Windows Phone **
		echo '<meta name="msapplication-navbutton-color" content="'.$color.'">';
		// iOS Safari
		echo '<meta name="apple-mobile-web-app-capable" content="yes">';
		echo '<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">';
	}
	?>
	<meta name="apple-mobile-web-app-title" content="Intranet <?php _e($site_description);?>">
	<?php add_action( 'wp_head', 'address_mobile_address_bar' ); ?>
	<link rel="shortcut icon" href="<?php _e(get_template_directory_uri());?>/icon/app-icon@16x16.png">
	<link rel="apple-touch-icon" href="<?php _e(get_template_directory_uri());?>/icon/app-icon@180x180.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php _e(get_template_directory_uri());?>/icon/app-icon@152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php _e(get_template_directory_uri());?>/icon/app-icon@180x180.png">
	<link rel="apple-touch-icon" sizes="167x167" href="<?php _e(get_template_directory_uri());?>/icon/app-icon@167x167.png">
	<link rel="icon" sizes="180x180" href="<?php _e(get_template_directory_uri());?>/icon/app-icon@180x180.png">
	<link rel="icon" sizes="120x120" href="<?php _e(get_template_directory_uri());?>/icon/app-icon@120x120.png">
	<?php
	wp_register_script(
		'bootstrap',
		get_template_directory_uri().'/css/bootstrap-master/dist/js/bootstrap.js',
		array('jquery',),
		'3.3.7'
	);
	add_action( 'wp_before_admin_bar_render', 'wpse20131211_admin_bar' );
	
	function wpse20131211_admin_bar() {
		global $wp_admin_bar;
//		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('new-post');
		$wp_admin_bar->remove_menu('customize');
		$wp_admin_bar->remove_menu('comments');
	}
		
	wp_enqueue_script("bootstrap");
	wp_head();
	
	?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style.css">

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->

</head>

<body <?php body_class(); ?>>
	<nav class="navbar navbar-default">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand"
					href="<?php echo esc_url( home_url( '/' ) ); ?>"
					title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
					rel="home">
						<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
					</a>
			</div>
			
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form
							class="navbar-form navbar-left"
							role="search"
							method="get"
							action="<?php echo esc_url( home_url( '/' ) ); ?>"
							>
							<div class="form-group">
								<input
									type="search"
									class="form-control"
									value="<?php echo (isset($_GET['s']) && $_GET['s']!='')?$_GET['s']:'';?>"
									name="s"
									placeholder="Buscar..."
									/>
							</div>
							<button type="submit" class="btn btn-default">Buscar</button>
						</form>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
<?php
	if ( ! isset( $content_width ) ) $content_width = 900;
?>

