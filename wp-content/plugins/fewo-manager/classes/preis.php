<?php
/**
 * Created by PhpStorm.
 * User: Freddy
 * Date: 26.08.2017
 * Time: 13:36
 */

class preis{

	private $id;
	private $wohnung_id;
	private $date_von;
	private $date_bis;
	private $bezeichnung;
	private $aufschlag;

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getWohnungId() {
		return $this->wohnung_id;
	}

	/**
	 * @param mixed $wohnung_id
	 */
	public function setWohnungId( $wohnung_id ) {
		$this->wohnung_id = $wohnung_id;
	}

	/**
	 * @return mixed
	 */
	public function getDateVon() {
		return $this->date_von;
	}

	/**
	 * @param mixed $date_von
	 */
	public function setDateVon( $date_von ) {
		$this->date_von = $date_von;
	}

	/**
	 * @return mixed
	 */
	public function getDateBis() {
		return $this->date_bis;
	}

	/**
	 * @param mixed $date_bis
	 */
	public function setDateBis( $date_bis ) {
		$this->date_bis = $date_bis;
	}

	/**
	 * @return mixed
	 */
	public function getBezeichnung() {
		return $this->bezeichnung;
	}

	/**
	 * @param mixed $bezeichnung
	 */
	public function setBezeichnung( $bezeichnung ) {
		$this->bezeichnung = $bezeichnung;
	}

	/**
	 * @return mixed
	 */
	public function getAufschlag() {
		return $this->aufschlag;
	}

	/**
	 * @param mixed $aufschlag
	 */
	public function setAufschlag( $aufschlag ) {
		$this->aufschlag = $aufschlag;
	}



	public function saveAll(array $data){

		global $wpdb;

		$data["dateVon"] = date("Y-m-d", strtotime($data["dateVon"]));
		$data["dateBis"] = date("Y-m-d", strtotime($data["dateBis"]));

		$this->date_von = "'".$data["dateVon"]."'";
		$this->date_bis = "'".$data["dateBis"]."'";
		$this->bezeichnung = "'".$data["bezeichnung"]."'";
		$this->aufschlag = "'".$data["aufschlag"]."'";


		$fewos = $wpdb->get_results("SELECT id from ".$wpdb->base_prefix."fewo_wohnungen");
		foreach ($fewos as $key => $content){

			$queryString =
				"INSERT INTO ".$wpdb->base_prefix."fewo_preise 
					(`wohnung_id`, `date_von`, `date_bis`, `bezeichnung`, `aufschlag`) VALUES 
					('".$fewos[$key]->id."', $this->date_von, $this->date_bis, $this->bezeichnung, $this->aufschlag);"
			;

			$wpdb->query($queryString);
		}
	}

	public function saveSolo(array $data){

		global $wpdb;

		$data["dateVon"] = date("Y-m-d", strtotime($data["dateVon"]));
		$data["dateBis"] = date("Y-m-d", strtotime($data["dateBis"]));

		$this->wohnung_id = "'".$data["wohnungId"]."'";
		$this->date_von = "'".$data["dateVon"]."'";
		$this->date_bis = "'".$data["dateBis"]."'";
		$this->bezeichnung = "'".$data["bezeichnung"]."'";
		$this->aufschlag = "'".$data["aufschlag"]."'";

		$queryString =
			"INSERT INTO ".$wpdb->base_prefix."fewo_preise 
					(`wohnung_id`, `date_von`, `date_bis`, `bezeichnung`, `aufschlag`) VALUES 
					($this->wohnung_id, $this->date_von, $this->date_bis, $this->bezeichnung, $this->aufschlag);"
		;

		$wpdb->query($queryString);
	}

	public function deletePreis($id){

		global $wpdb;

		$wpdb->delete("fewo_preise",["id" => $id]);
	}


}