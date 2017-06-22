<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * Add content to the Shortcode
 */

function wp_pharma_display_form() {
	if ( ! empty( $_GET['id'] ) && $_GET['id'] == 'upload' ) { ?>
		<div class="content-customer-area">
		<?php acf_form( array(
			'post_id'         => 'new_post',
			'post_title'      => true,
			'new_post'        => array(
				'post_type'   => 'wp_pharma_ordo',
				'post_status' => 'publish',
			),
			'submit_value'    => __( 'Add a prescription', 'wp_pharma' ),
			'updated_message' => '<div class="updated_message"><p>'.  __('Presciption well received', 'wp_pharma') .'</p></div>',
			'honeypot'        => true,
		) );
	}
}

function wp_pharma_prepare_title( $title ) {
	// override value
	$date = get_field('wp_pharma_initial_date');
    $title = $title . '-' . $date;

    return $title;

}
add_filter('the_title', 'wp_pharma_prepare_title');

function wp_pharma_display_list(){
	if ( ! empty( $_GET['id'] ) && $_GET['id'] == 'history' ) { ?>
		<div class="content-customer-area">
			<?php echo wp_pharma_get_prescription(); ?>
		</div>
	<?php }
}

function wp_pharma_get_prescription(){
    $current_user_id = get_current_user_id();
    // WP_Query arguments
$args = array(
	'post_type'              => array( 'wp_pharma_ordo' ),
	'post_status'            => array( 'publish' ),
	'author'                 => $current_user_id,
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post(); ?>
		<div class="prescription_item">
		    <?php the_title(); ?>
        </div>
	<?php }
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();
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