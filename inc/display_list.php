<?php
/**
 * Created by PhpStorm.
 * User: sebastien
 * Date: 23/06/17
 * Time: 07:22
 */

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
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

function wp_pharma_display_list(){
	if ( ! empty( $_GET['id'] ) && $_GET['id'] == 'history' ) { ?>
		<div class="content-customer-area">
			<?php echo wp_pharma_get_prescription(); ?>
		</div>
	<?php }
}