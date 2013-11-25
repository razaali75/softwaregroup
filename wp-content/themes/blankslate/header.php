<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(' | ', true, 'right'); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700,300' rel='stylesheet' type='text/css'>
    <script src="<?php bloginfo('template_url');?>/js/jquery.min.js" type="text/javascript"></script>		    
    <script type="text/javascript" src="http://baijs.nl/tinycarousel/js/jquery.tinycarousel.js"></script>  

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header id="header">
<?php $wptuts_options = get_option( 'theme_wptuts_options' ); ?>
<div class="container">
<div id="logo"><a href="/">
<img src="<?php echo $wptuts_options['logo']; ?>" /></a> <!-- wp-content/themes/blankslate/images/logo.png-->
</div>


<nav id="navigation">

<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
</nav>

</div>

</header>
