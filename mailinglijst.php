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
*/

global $mailinglijst;

require_once(__DIR__ . '/options.php');

class WP_Mailinglijst {
	function __construct() {
		$this->options = get_option('mailinglijst');

		add_shortcode('mailinglijst', array($this, 'shortcode'));
	}

	function fast($att) {
		$html = '';
		$html.= '<form action="http://subscribe.mailinglijst.nl" method="get">';
		$html.= '<input type="hidden" name="l" value="'.esc_attr($this->options['lijstnummer']).'" />';
		$html.= '<input type="hidden" name="fast" value="1" />';
		$html.= '<input type="text" id="mailinglijst_n" name="n" />';
		$html.= '<input type="email" id="mailinglijst_e" name="e" />';
		$html.= '<input type="submit" value="Registreren" />';
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

	function shortcode($att, $content) {
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
