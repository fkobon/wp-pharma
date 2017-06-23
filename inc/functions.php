<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

function wp_pharma_login(){
    if ( ! is_user_logged_in()){
		wp_login_form(  );
            }
}

/*Check if post is duplicated*/
function disable_save( $maybe_empty, $postarr ) {
	if ( ! function_exists( 'post_exists' )) {
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
	}
    if(post_exists($postarr['post_title']) && $postarr['post_type'] == 'wp_pharma_ordo' )
    {
        /*This if statment important to allow update and trash of the post and only prevent new posts with new ids*/
        if(!get_post($postarr['ID']))
    	{
    	      $maybe_empty = true;
        }
    }
    else
    {
    	$maybe_empty = false;
    }

    return $maybe_empty;
}
add_filter( 'wp_insert_post_empty_content', 'disable_save', 999999, 2 );