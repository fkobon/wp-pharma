<?php

/**
 * Created by PhpStorm.
 * User: sebastien
 * Date: 12/02/16
 * Time: 12:52
 */
class settings {
	public function __construct() {
		add_action('admin_menu', array($this, 'add_admin_menu'));
		add_action('admin_init', array($this, 'register_settings'));
	}

	public function add_admin_menu()

	{
		add_menu_page('WP-Pharma', 'WP-Pharma', 'manage_options', 'wp-pharma', array($this, 'menu_html'),WP_PHARMA_URL . 'assets/img/icon.png');
		//add_submenu_page('messeinfo',__('Options','messesinfo'),__('Options','messesinfo'),'manage_options', 'option_menu', array($this, 'promote_html'));

	}

	public function register_settings(){
		add_settings_section('wp_pharma_licence_key', __('Licence Key','wp-pharma'), array($this, 'menu_html'), 'wp_pharma_settings');
		register_setting('messeinfo_settings', 'thfo_ads');
		add_settings_field('wp_pharma_licence', __('Add your licence key', 'wp-pharma'), array($this, 'menu_html'),'wp_pharma_settings', 'wp_pharma_licence_key');

	}

	public function menu_html() {
		echo '<h1>' . get_admin_page_title() . '</h1>';
	}

	public function options_html(){
		echo '<h2>Options</h2>';
	}

	public function promote_html(){
		?>
		<form method="post" action="options.php">
			<?php settings_fields('messeinfo_settings') ?>
			<?php do_settings_sections('messeinfo_settings') ?>
			<?php submit_button(__('Save')); ?>


		</form>

		<?php
	}

	public function ads_html(){
		$promote = get_option('thfo_ads');?>
		<input type="radio" value="1" name="thfo_ads" <?php if($promote == '1'){ echo "checked"; }?>> <?php _e('yes','messesinfo')?>
		<input type="radio" value="0" name="thfo_ads" <?php if($promote == '0'){ echo "checked"; }?>> <?php _e('no','messesinfo')?>
	<?php }

}

new settings();