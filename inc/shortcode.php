<?php

add_shortcode( 'customer_area', 'wp_pharma_customer_area_sc' );
function wp_pharma_customer_area_sc( $atts ) {
	ob_start();
	if ( is_user_logged_in() ) {
		$prescription_upload_menu_title = apply_filters( 'prescription_upload', __( 'Upload a Pharmacy prescription', 'wp_pharma' ) );
		$prescription_history_title     = apply_filters( 'prescription_history', __( 'My pharmacy prescription', 'wp_pharma' ) );


			?>
            <div class="menu-customer-area">
                <ul>
                    <li><a href="?id=upload"> <?php echo $prescription_upload_menu_title ?></a></li>
                    <li><a href="?id=history"> <?php echo $prescription_history_title ?></a></li>
                </ul>
            </div>
        <?php if ( ! empty( $_GET['id'] ) && $_GET['id'] == 'upload' ) { ?>
            <div class="content-customer-area">
                <?php acf_form( array(
	                'post_id'      => 'new_post',
	                'post_title'   => true,
	                'new_post'     => array(
		                'post_type'   => 'wp_pharma_ordo',
		                'post_status' => 'publish'
	                ),
	                'submit_value' => __('Ajouter mon annonce', 'twentyfourteen'),
	                'updated_message'    => '<div class="updated_message"><p>Votre annonce est publiée. Une modération pourra etre apportée si l\'annonce ne corresponds pas à nos critères</p></div>',
	                'honeypot' => true,
                ) ); ?>
            </div> <?php
		}
	} else {
		$sc = '<p>' . __( 'You\'re not allowed to visit visit page', 'wp_pharma' ) . '</p>';

		return $sc;
	}

	$html = ob_get_contents();
	ob_end_clean();

	return $html;
}

add_action('wp_handle_upload', 'wp_pharma_get_form');
function wp_pharma_get_form(){
    if (isset($_POST['submit_prescription'])){


	    $uploadedfile = $_FILES['prescription_file'];
	    $movefile = wp_handle_upload( $uploadedfile );

die(var_dump($movefile));

    }
}