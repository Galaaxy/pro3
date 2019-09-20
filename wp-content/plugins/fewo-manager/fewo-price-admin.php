<?php
/**
 * Created by PhpStorm.
 * User: Freddy
 * Date: 17.08.2017
 * Time: 10:28
 */

if(isset($_POST)){

	if(isset($_POST["submit"])){

		if($_POST["submit"] == "saveAll"){
			saveAll($_POST);
		}
		if($_POST["submit"] == "saveSolo"){
			saveSolo($_POST);
		}
		if($_POST["submit"] == "delete"){
			deletePreis($_POST["id"]);
		}
	}
}

renderPreise();

function renderPreise(){

	$context["preise"]      = buildList();
	$context["fewos"]       = getFewoIds();
	$context["plugin_url"]  = plugins_url()."/fewo-manager";
	$context["actual_url"]  = $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	Timber::render("preise.html.twig", $context);

}

/**
 * Baut die Tabelle wichtig für renderPreise()
 */
function buildList(){

	global $wpdb;
	$preise = $wpdb->get_results("
		SELECT 
			fewo.id AS fewo_id, fewo.name AS fewo_name, fewo.preis AS fewo_preis, preis.id,preis.wohnung_id, preis.date_von, preis.date_bis, preis.bezeichnung, preis.aufschlag 
		FROM
			".$wpdb->base_prefix."fewo_preise AS preis 
		LEFT JOIN
			".$wpdb->base_prefix."fewo_wohnungen AS fewo 
		ON
			preis.wohnung_id = fewo.id
		ORDER BY
			preis.wohnung_id ASC
		");

	return $preise;
}

function getFewoIds(){
	include_once "classes/wohnung.php";
	$ids = new wohnung();
	return $ids->getAllIds();
}

function saveAll(array $data){

	include_once "classes/preis.php";
	$preise = new preis();
	$preise->saveAll($data);
}

function saveSolo(array $data){

	include_once "classes/preis.php";
	$preise = new preis();
	$preise->saveSolo($data);
}

function deletePreis(){
	include_once "classes/preis.php";
	$preis = new preis();
	$preis->deletePreis($_POST["id"]);
}