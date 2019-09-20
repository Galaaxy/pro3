<?php
/**
 * Created by PhpStorm.
 * User: Freddy
 * Date: 07.08.2017
 * Time: 17:40
 */

class wohnung {

	private $id;
	private $name;
	private $groesse;
	private $zimmer;
	private $schlafzimmer;
	private $badezimmer;
	private $wohnzimmer;
	private $kuechen;
	private $preis;
	private $preisExtraPP;
	private $preisExtraAb;
	private $maxP;
	private $reinigung;
	private $hunde;
	private $hundeExtra;
	private $hundeReinigung;
	private $text;
	private $wifi;
	private $aufenthalt;

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getGroesse() {
		return $this->groesse;
	}

	/**
	 * @param mixed $groesse
	 */
	public function setGroesse( $groesse ) {
		$this->groesse = $groesse;
	}

	/**
	 * @return mixed
	 */
	public function getZimmer() {
		return $this->zimmer;
	}

	/**
	 * @param mixed $zimmer
	 */
	public function setZimmer( $zimmer ) {
		$this->zimmer = $zimmer;
	}

	/**
	 * @return mixed
	 */
	public function getSchlafzimmer() {
		return $this->schlafzimmer;
	}

	/**
	 * @param mixed $schlafzimmer
	 */
	public function setSchlafzimmer( $schlafzimmer ) {
		$this->schlafzimmer = $schlafzimmer;
	}

	/**
	 * @return mixed
	 */
	public function getBadezimmer() {
		return $this->badezimmer;
	}

	/**
	 * @param mixed $badezimmer
	 */
	public function setBadezimmer( $badezimmer ) {
		$this->badezimmer = $badezimmer;
	}

	/**
	 * @return mixed
	 */
	public function getWohnzimmer() {
		return $this->wohnzimmer;
	}

	/**
	 * @param mixed $wohnzimmer
	 */
	public function setWohnzimmer( $wohnzimmer ) {
		$this->wohnzimmer = $wohnzimmer;
	}

	/**
	 * @return mixed
	 */
	public function getKuechen() {
		return $this->kuechen;
	}

	/**
	 * @param mixed $kuechen
	 */
	public function setKuechen( $kuechen ) {
		$this->kuechen = $kuechen;
	}

	/**
	 * @return mixed
	 */
	public function getPreis() {
		return $this->preis;
	}

	/**
	 * @param mixed $preis
	 */
	public function setPreis( $preis ) {
		$this->preis = $preis;
	}

	/**
	 * @return mixed
	 */
	public function getPreisExtraPP() {
		return $this->preisExtraPP;
	}

	/**
	 * @param mixed $preisExtraPP
	 */
	public function setPreisExtraPP( $preisExtraPP ) {
		$this->preisExtraPP = $preisExtraPP;
	}

	/**
	 * @return mixed
	 */
	public function getPreisExtraAb() {
		return $this->preisExtraAb;
	}

	/**
	 * @param mixed $preisExtraAb
	 */
	public function setPreisExtraAb( $preisExtraAb ) {
		$this->preisExtraAb = $preisExtraAb;
	}

	/**
	 * @return mixed
	 */
	public function getMaxP() {
		return $this->maxP;
	}

	/**
	 * @param mixed $maxP
	 */
	public function setMaxP( $maxP ) {
		$this->maxP = $maxP;
	}

	/**
	 * @return mixed
	 */
	public function getReinigung() {
		return $this->reinigung;
	}

	/**
	 * @param mixed $reinigung
	 */
	public function setReinigung( $reinigung ) {
		$this->reinigung = $reinigung;
	}

	/**
	 * @return mixed
	 */
	public function getHunde() {
		return $this->hunde;
	}

	/**
	 * @param mixed $hunde
	 */
	public function setHunde( $hunde ) {
		$this->hunde = $hunde;
	}

	/**
	 * @return mixed
	 */
	public function getHundeExtra() {
		return $this->hundeExtra;
	}

	/**
	 * @param mixed $hundeExtra
	 */
	public function setHundeExtra( $hundeExtra ) {
		$this->hundeExtra = $hundeExtra;
	}

	/**
	 * @return mixed
	 */
	public function getHundeReinigung() {
		return $this->hundeReinigung;
	}

	/**
	 * @param mixed $hundeReinigung
	 */
	public function setHundeReinigung( $hundeReinigung ) {
		$this->hundeReinigung = $hundeReinigung;
	}

	/**
	 * @return mixed
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * @param mixed $text
	 */
	public function setText( $text ) {
		$this->text = $text;
	}

	/**
	 * @return mixed
	 */
	public function getWifi() {
		return $this->wifi;
	}

	/**
	 * @param mixed $wifi
	 */
	public function setWifi( $wifi ) {
		$this->wifi = $wifi;
	}

	/**
	 * @return mixed
	 */
	public function getAufenthalt() {
		return $this->aufenthalt;
	}

	/**
	 * @param mixed $aufenthalt
	 */
	public function setAufenthalt( $aufenthalt ) {
		$this->aufenthalt = $aufenthalt;
	}

	/**
	 * ======================
	 * Costum Functions
	 * ======================
	 */

	/**
	 * @param array $data
	 */
	public function saveWohnung(array $data){

		global $wpdb;

			$this->id               = $data["ewId"];
			$this->name             = "'".$data["ewName"]."'";
			$this->groesse          = "'".$data["ewGroesse"]."'";
			$this->zimmer           = "'".$data["ewZimmer"]."'";
			$this->schlafzimmer     = "'".$data["ewSchlafzimmer"]."'";
			$this->badezimmer       = "'".$data["ewBadezimmer"]."'";
			$this->wohnzimmer       = "'".$data["ewWohnzimmer"]."'";
			$this->kuechen          = "'".$data["ewKuechen"]."'";
			$this->preis            = "'".$data["ewPreis"]."'";
			$this->preisExtraPP     = "'".$data["ewExtraPP"]."'";
			$this->preisExtraAb     = "'".$data["ewExtraAb"]."'";
			$this->maxP             = "'".$data["ewMaxP"]."'";
			$this->reinigung        = "'".$data["ewReinigung"]."'";
			$this->hunde            = "'".$data["ewHunde"]."'";
			$this->hundeExtra       = "'".$data["ewHundeExtra"]."'";
			$this->hundeReinigung   = "'".$data["ewHundeExtraReinigung"]."'";
			$this->wifi             = "'".$data["ewWifi"]."'";
			$this->text             = "'".$data["text"]."'";
			$this->aufenthalt       = "'".$data["ewAufenthalt"]."'";

			$queryString =
				"UPDATE ".$wpdb->base_prefix."fewo_wohnungen SET
 
				name 			= $this->name, 
				groesse 		= $this->groesse, 
				zimmer 			= $this->zimmer, 
				schlafzimmer 	= $this->schlafzimmer, 
				badezimmer 		= $this->badezimmer, 
				wohnzimmer 		= $this->wohnzimmer, 
				kuechen 		= $this->kuechen, 
				preis 			= $this->preis, 
				preisExtraPP 	= $this->preisExtraPP, 
				preisExtraAb 	= $this->preisExtraAb, 
				maxP 			= $this->maxP, 
				reinigung 		= $this->reinigung, 
				hunde 			= $this->hunde, 
				hundeExtra 		= $this->hundeExtra, 
				hundeReinigung 	= $this->hundeReinigung,
				wifi			= $this->wifi,
				text			= $this->text,
				aufenthalt		= $this->aufenthalt
				
				WHERE id = $this->id;"
			;


		$wpdb->query($queryString);
	}

	public function createWohnung(){

		global $wpdb;
		$queryString = "INSERT INTO ".$wpdb->base_prefix."fewo_wohnungen (`name`) VALUES ('Ferienwohnung Neu');";

		$wpdb->query($queryString);
	}

	public function deleteWohnung($id){

		global $wpdb;

		$wpdb->delete($wpdb->base_prefix."fewo_wohnungen",["id" => $id]);
	}

	public function getAllIds(){
		global $wpdb;

		return $wpdb->get_results("SELECT id, name from ".$wpdb->base_prefix."fewo_wohnungen");
	}
}