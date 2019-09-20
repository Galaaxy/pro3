<?php
/**
 * Created by PhpStorm.
 * User: Freddy
 * Date: 07.03.2018
 * Time: 16:58
 */

class mods {

	private $modName;
	private $modSetting;
	private $modArr;
	private $newArray = [];
	private $arrayLength;


	public function __construct($modName, $modSetting, $modArr) {
		$this->modName = $modName;
		$this->modSetting = $modSetting;
		$this->modArr = $modArr;
		$this->arrayLength = count($modSetting);
		$this->createArrPflicht();
	}

	public function createArrPflicht(){
		for($i = 1; $i <= count($this->modArr); $i++){

			foreach ($this->modSetting as $modKey => $modValue){

				if($modValue == 1){
					if(isset($this->modArr[$this->modName."_".$modKey."_".$i]) && strlen($this->modArr[$this->modName."_".$modKey."_".$i]) != 0){

						$this->newArray[ $i ][ $modKey ] = $this->modArr[ $this->modName."_".$modKey . "_" . $i ];

					}else{
						if ( isset( $this->newArray[ $i ] ) ) {
							unset( $this->newArray[ $i ] );
						}
						break 2;
					}
				}else if(isset($this->modArr[$this->modName."_".$modKey."_".$i]) && strlen($this->modArr[$this->modName."_".$modKey."_".$i]) != 0) {

						$this->newArray[ $i ][ $modKey ] = $this->modArr[ $this->modName."_".$modKey . "_" . $i ];
					}
				}



			}

		}



	public function cropImg($arrName, $cropSize, $settingName){

		for($i = 1; $i <= count($this->newArray); $i++){

			foreach ($this->newArray[$i] as $ArrKey => $ArrValue){

				if($ArrKey == $settingName){
					$postId = $this->get_image_id($this->newArray[$i][$settingName]);
					$this->newArray[$i][$arrName] = wp_get_attachment_image_src($postId,$cropSize);
				}
			}
		}

	}

	public function get_image_id($image_url){
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
		return $attachment[0];
	}

	public function getArr(){
		return $this->newArray;
	}

	public function returnMod(){
		return $this->modArr;
	}

}