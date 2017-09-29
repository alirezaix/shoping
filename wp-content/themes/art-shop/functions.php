<?php
//Theme Define
define( 'THEMEROOT' , get_template_directory_uri() );
define( 'IMG' , THEMEROOT . '/assets/img' );
define( 'JS' , THEMEROOT . '/assets/js' );
define( 'CSS' , THEMEROOT . '/assets/css' );
define( 'FONT' , THEMEROOT . '/assets/fonts' );
define( 'INC' , THEMEROOT . '/inc' );
//Theme Filters
add_filter( 'show_admin_bar' , '__return_false' );
function custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length' , 'custom_excerpt_length' );
function wpdocs_excerpt_more( $more ) {
	return '   ...';
}
add_filter( 'excerpt_more' , 'wpdocs_excerpt_more' );
function get_image_url() {
	$image_id  = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src( $image_id , 'full' );
	$image_url = $image_url[ 0 ];
	echo $image_url;
}
//Theme My Script Site JS
function add_myScript_assets() {
	/*************************************************************************************************************/
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery' , 'http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js' , false );
		wp_enqueue_script( 'jquery' );
	}
	/*************************************************************************************************************/
	//Bootstrap
	wp_enqueue_style( 'b-s-css' , CSS . '/bootstrap.min.css' , array() , '4.0.0' );
	wp_enqueue_script( 'b-s-js' , JS . '/bootstrap.min.js' , array( 'jquery' ) , null , true );
	/*************************************************************************************************************/
	wp_enqueue_style( 'font-aw' , CSS . '/font-awesome.min.css' , array( 'bootstrap' ) , '4.7.0' );
	/*************************************************************************************************************/
}
//Action My Script Site JS
add_action( 'wp_enqueue_scripts' , 'add_myScript_assets' );
add_action( 'after_switch_theme' , 'art_switch_theme' );
function art_switch_theme() {

	flush_rewrite_rules();

}