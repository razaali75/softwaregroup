<?php
/**
 * Template Name: Homepage
 *
 */
?>
<?php get_header(); ?>

<?php $wptuts_options = get_option( 'theme_wptuts_options' ); ?>

<?php include(TEMPLATEPATH."/slider.php");?>



<?php include(TEMPLATEPATH."/cta.php");?>


<?php include(TEMPLATEPATH."/clients.php");?>

<?php include(TEMPLATEPATH."/our-strat.php");?>

<?php include(TEMPLATEPATH."/choose.php");?>



<?php include(TEMPLATEPATH."/stories.php");?>



<?php get_footer(); ?>