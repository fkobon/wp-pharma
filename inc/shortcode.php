<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

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
        <div class="content-customer-area <?php
		echo apply_filters( 'wp_pharma_display_class', $class = '' );
		?>">
        <?php echo wp_pharma_display_form() ?>
        <?php echo wp_pharma_display_list() ?>
        </div>
            </div> <?php

	} else {
		echo wp_pharma_login();
	}

	$html = ob_get_contents();
	ob_end_clean();

	return $html;
}