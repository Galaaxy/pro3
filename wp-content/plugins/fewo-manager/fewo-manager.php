<?php

/**
 * @wordpress-plugin
 * Plugin Name:       FeWo Manager
 * Description:       Fewo Manager Plugin for you
 * Version:           1.0.0
 * Author:            Frédéric Haubold
 * Author URI:        https://hauboldmedia.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Activation Hooks
 */
function fewo_manager_activate(){

	global $wpdb;

	$tables = [
		"$wpdb->base_prefix"."fewo_bilder" => "CREATE TABLE `".$wpdb->base_prefix."fewo_bilder` (
					`id` INT(11) NOT NULL AUTO_INCREMENT,
					`fewo_id` INT(11) NOT NULL DEFAULT '0',
					`posts_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
					`marker` INT(2) NOT NULL DEFAULT '0',
					PRIMARY KEY (`id`),
					INDEX `FK_".$wpdb->base_prefix."fewo_bilder_".$wpdb->base_prefix."fewo_wohnungen` (`fewo_id`),
					INDEX `FK_".$wpdb->base_prefix."fewo_bilder_wp_posts` (`posts_id`),
					CONSTRAINT `FK_".$wpdb->base_prefix."fewo_bilder_".$wpdb->base_prefix."fewo_wohnungen` FOREIGN KEY (`fewo_id`) REFERENCES `".$wpdb->base_prefix."fewo_wohnungen` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
					CONSTRAINT `FK_".$wpdb->base_prefix."fewo_bilder_wp_posts` FOREIGN KEY (`posts_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE ON DELETE CASCADE
				)
				COLLATE='utf8_general_ci'
				ENGINE=InnoDB
				AUTO_INCREMENT=1
				;",
		"$wpdb->base_prefix"."fewo_preise" => "CREATE TABLE `".$wpdb->base_prefix."fewo_preise` (
					`id` INT(11) NOT NULL AUTO_INCREMENT,
					`wohnung_id` INT(11) NULL DEFAULT '0',
					`date_von` DATE NOT NULL,
					`date_bis` DATE NOT NULL,
					`bezeichnung` VARCHAR(50) NOT NULL DEFAULT 'Hauptsaison',
					`aufschlag` INT(11) NULL DEFAULT '0',
					PRIMARY KEY (`id`),
					INDEX `wohnung_id` (`wohnung_id`),
					CONSTRAINT `FK_".$wpdb->base_prefix."fewo_preise_".$wpdb->base_prefix."fewo_wohnungen` FOREIGN KEY (`wohnung_id`) REFERENCES `".$wpdb->base_prefix."fewo_wohnungen` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
				)
				COLLATE='utf8_general_ci'
				ENGINE=InnoDB
				AUTO_INCREMENT=1
				;",
		"$wpdb->base_prefix"."fewo_wohnungen" => "CREATE TABLE `".$wpdb->base_prefix."fewo_wohnungen` (
					`id` INT(11) NOT NULL AUTO_INCREMENT,
					`name` VARCHAR(50) NULL DEFAULT NULL,
					`groesse` DOUBLE NULL DEFAULT '0',
					`zimmer` INT(3) NULL DEFAULT NULL,
					`schlafzimmer` INT(3) NULL DEFAULT NULL,
					`badezimmer` INT(3) NULL DEFAULT NULL,
					`wohnzimmer` INT(3) NULL DEFAULT NULL,
					`kuechen` INT(3) NULL DEFAULT NULL,
					`preis` DOUBLE NULL DEFAULT '0',
					`preisExtraPP` DOUBLE NULL DEFAULT NULL,
					`preisExtraAb` INT(3) NULL DEFAULT NULL,
					`maxP` INT(3) NULL DEFAULT NULL,
					`reinigung` DOUBLE NULL DEFAULT NULL,
					`hunde` TINYINT(1) NULL DEFAULT '0',
					`hundeExtra` DOUBLE NULL DEFAULT NULL,
					`hundeReinigung` DOUBLE NULL DEFAULT NULL,
					`wifi` INT(11) NULL DEFAULT '0',
					`aufenthalt` INT(11) NULL DEFAULT '1',
					`text` TEXT NULL,
					PRIMARY KEY (`id`)
				)
				COLLATE='utf8_general_ci'
				ENGINE=InnoDB
				AUTO_INCREMENT=1
				;
"
	];


	// Doppelter Tabellencheck aufgrund der Referentiellen Integrität muss doppelt geprüft werden.
		foreach($tables as $key => $val){
			$res = $wpdb->query("
			SELECT
	        	table_name
	        FROM
	        	information_schema.tables
	        WHERE
	        	table_schema = '$wpdb->dbname'
	        AND
	        	table_name LIKE '$key'
	    ");

			if($res === 0 || $res === null || $res === false){
				$wpdb->query(
					$val
				);
			}

		}
		foreach($tables as $key => $val){
			$res = $wpdb->query("
			SELECT
						table_name
					FROM
						information_schema.tables
					WHERE
						table_schema = '$wpdb->dbname'
					AND
						table_name LIKE '$key'
			");

			if($res === 0 || $res === null || $res === false){
				$wpdb->query(
					$val
				);
			}

		}


}
register_activation_hook(__FILE__, 'fewo_manager_activate');

/**
 * ================================
 * ## Includes
 * ================================
 */

/**
 * Actions
 */
add_action("admin_menu","fewo_menu");
add_action("admin_menu","price_menu");
add_action('after_setup_theme','newImageSize');

/**
 * Shortcodes
 */
add_shortcode('fewo', 'fewo_shortcodes');
add_shortcode('preis', 'preis_shortcodes');

/**
 * Filter
 */
add_filter('timber/twig','add_to_twig');


/**
 * ================================
 * ## Functions
 * ================================
 */

function fewo_menu() {

	add_menu_page(
		"FeWo Manager",
		"FeWo Manager",
		"manage_options",
		"fewo-manager",
		"fewo_manager_admin");
}


function fewo_manager_admin(){
	if(!current_user_can("manage_options")){
		wp_die(__("You do not have sufficient permissions to acces this page."));
	}

	include_once "fewo-manager-admin.php";
}

function price_menu(){

	add_menu_page(
		"Preise",
		"Preise",
		"manage_options",
		"preis",
		"fewo_price_admin");
}

function fewo_price_admin(){
	if(!current_user_can("manage_options")){
		wp_die(__("You do not have sufficient permissions to acces this page."));
	}

	include_once "fewo-price-admin.php";
}

/**
 * =============================
 * FILTER FUNCTIONS
 * =============================
 */

function newImageSize(){
	add_image_size('fewo-thumb',250,250, true);
	add_image_size('fewo-big',1150,700, true);
	add_image_size('fewo-small',190,90, true);
	add_image_size('fewo-start',710,414, true);
}

/**
 * =============================
 * SHORTCODES
 * =============================
 */

function fewo_shortcodes($atts){

	global $wpdb;

	$wohnungen = $wpdb->get_results("SELECT * from ".$wpdb->base_prefix."fewo_wohnungen");

	$shortcode = ["id"];

	foreach ($wohnungen as $key => $content){
		$id = $wohnungen[$key]->id;
		$shortcode["id"][$id] = $id;
	}
	shortcode_atts($shortcode, $atts);

	if(isset($atts) && $atts !== empty($atts)){

		$wohnung = $wpdb->get_row("SELECT * from ".$wpdb->base_prefix."fewo_wohnungen WHERE id = ".$atts["id"]);
		$bilder = loadImagesFrontend($atts["id"]);
		$context["plugin_url"]  = plugins_url()."/fewo-manager";
		$context["wohnung"] = $wohnung;
		$context["wohnung"]->text = nl2br($context["wohnung"]->text);
		$context["bilder"] = $bilder;

		Timber::render("wohnung-frontend.html.twig",$context);
	}

}

function preis_shortcodes($atts){
	global $wpdb;

	$wohnungen = $wpdb->get_results("SELECT id from ".$wpdb->base_prefix."fewo_wohnungen");

	$shortcode = ["id"];

	foreach ($wohnungen as $key => $content){
		$id = $wohnungen[$key]->id;
		$shortcode["id"][$id] = $id;
	}
	shortcode_atts($shortcode, $atts);

	if(isset($atts) && $atts !== empty($atts)){

		$context["wohnung"] = $wpdb->get_row("SELECT id, name, preis, preisExtraPP, preisExtraAb, maxP, hunde, hundeExtra from ".$wpdb->base_prefix."fewo_wohnungen WHERE id = ".$atts["id"]);
		$context["preise"] = $wpdb->get_results("SELECT date_von, date_bis, bezeichnung, aufschlag from ".$wpdb->base_prefix."fewo_preise WHERE wohnung_id = ".$atts["id"]." ORDER BY date_von ASC");

		$context["plugin_url"]  = plugins_url()."/fewo-manager";

		Timber::render("preistabelle-frontend.html.twig",$context);
	}
}
/**
 * =============================
 * SHORTCODE HELPER
 * =============================
 */

function loadImagesFrontend($id){

	global $wpdb;


	$images = [];

	$bilder = $wpdb->get_results('SELECT fewo.posts_id FROM '.$wpdb->base_prefix.'fewo_bilder AS fewo LEFT JOIN '.$wpdb->base_prefix.'posts AS wp ON fewo.posts_id = wp.id WHERE fewo.fewo_id = '.$id);

	foreach($bilder as $key => $item){
		$images[$key]["img_thumb"] = wp_get_attachment_image_src($item->posts_id,"fewo-small");
		$images[$key]["img_big"] = wp_get_attachment_image_src($item->posts_id,"fewo-big");
		$images[$key]["id"] = $bilder[$key]->posts_id;
	}

	return $images;

}

function loadImagesFrontendMarked($id){

	global $wpdb;

	$images = [];

	$bilder = $wpdb->get_results("SELECT fewo.posts_id FROM ".$wpdb->base_prefix."fewo_bilder AS fewo LEFT JOIN '.$wpdb->base_prefix.'posts AS wp ON fewo.posts_id = wp.id WHERE fewo.marker = 1 AND fewo.fewo_id = ".$id);

	foreach($bilder as $key => $item){
		$images[$key]["img_start"] = wp_get_attachment_image_src($item->posts_id,"fewo-start");
		$images[$key]["id"] = $bilder[$key]->posts_id;
	}

	return $images;

}

function add_to_twig($twig) {
	/* this is where you can add your own functions to twig */
	$twig->addExtension(new Twig_Extension_StringLoader());
	$twig->addFilter(new Twig_SimpleFilter('wp_editor', 'editor'));
	return $twig;
}

function editor($text) {

	wp_editor($text,"text",[
		"media_buttons" => "false"
	]);
}
