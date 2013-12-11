<?php
/**
 * @package Mailinglijst
 * @version 0.1
 */
/*
Plugin Name: Mailinglijst
Plugin URI: http://wordpress.org/plugins/mailinglijst/
Description: Integrate Mailinglijst sign-up forms into your website.
Author: Jeroen Schmit, Slim & Dapper
Version: 0.1
Author URI: http://slimndap.com/
Text Domain: mailinglijst
*/

global $mailinglijst;

require_once(__DIR__ . '/options.php');

class WP_Mailinglijst_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mailinglijst_widget', // Base ID
			__('Mailinglijst', 'text_domain'), // Name
			array( 'description' => __( 'Sign-up form', 'text_domain' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $mailinglijst;
		echo $mailinglijst->render();
	}

}

class WP_Mailinglijst {
	function __construct() {
		
		$this->options = get_option('mailinglijst');

		add_shortcode('mailinglijst', array($this, 'render'));

		add_action( 'widgets_init', function(){
		     register_widget( 'WP_Mailinglijst_Widget' );
		});
		
		add_action('plugins_loaded', function(){
			load_plugin_textdomain('mailinglijst', false, 'mailinglijst/languages' );
		});

	}

	function fast($att) {
		$html = '';
		$html.= '<form action="http://subscribe.mailinglijst.nl" method="get">';
		$html.= '<input type="hidden" name="l" value="'.esc_attr($this->options['lijstnummer']).'" /></label>';
		$html.= '<input type="hidden" name="fast" value="1" />';
		$html.= '<label><span>'.__('Name','mailinglijst').'</span><input type="text" id="mailinglijst_n" name="n" /></label>';
		$html.= '<label><span>'.__('Email','mailinglijst').'</span><input type="email" id="mailinglijst_e" name="e" /></label>';
		$html.= '<input type="submit" value="'.__('Register','mailinglijst').'" />';
		$html.= '</form>';
		return $html;
	}

	function popup($att, $content) {
		wp_enqueue_script('mailinglijst', plugins_url( 'js/nieuwsbrief_v2.js', __FILE__ ), array(), NULL, TRUE );
		return '<a href="javascript:subscribe('.$this->options['lijstnummer'].');">'.$content.'</a>';
	}

	function iframe($att) {
		return '<iframe src="http://subscribe.mailinglijst.nl/?l='.$this->options['lijstnummer'].'"></iframe>';			
	}

	function render($att='', $content='') {
		switch ($this->options['formtype']) {
			case 'iframe' :
				return $this->iframe($att);
				break;
			case 'fast' :
				return $this->fast($att);
				break;
			default :
				return $this->popup($att, $content);
		}
	}
}

$mailinglijst = new WP_Mailinglijst();
?>
