<?php

include_once "customizer_class.php";

function hauboldmedia_customizer_settings($wp_customize) {

    /**
	 * ================================
	 * ## Additional Functions / Extends
	 * ================================
	 */
	class pro_info extends WP_Customize_Control {
		public $type = 'info';
		public $label = '';
		public function render_content() {
			?>
            <h3 style="margin-top:30px;border:1px solid;padding:5px;color:#58719E;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
			<?php
		}
	}

	/**
	 * ================================
	 * ## Options
	 * ================================
	 */

	/**
	 * Wieviele Teammitglieder im Customizer angezeigt werden sollen
	 */
	$anzahlTeam     = 6;
	$anzahlGalerie  = 8;
	$anzahlSlider   = 6;

	/**
	 * prioritys | Reihenfolge der Customizer Module
	 */
	$sliderPrio     = 120;
	$galeriePrio    = 125;
	$teamPrio       = 130;

	/**
	 * ================================
	 * ## Initialisiere Module
	 * ================================
	 */

	/**
	 * Create Slider Module
	 */
	$slider = new customizer_class();
	$slider->slider_module($wp_customize, $anzahlSlider, $sliderPrio);

	/**
	 * Create Galerie Module
	 */
    $galerie = new customizer_class();
    $galerie->galerie_module($wp_customize, $anzahlGalerie, $galeriePrio);

    /**
     * Create Team Module
     */
    $team = new customizer_class();
    $team->team_module($wp_customize, $anzahlTeam, $teamPrio);

}
add_action('customize_register', 'hauboldmedia_customizer_settings');

