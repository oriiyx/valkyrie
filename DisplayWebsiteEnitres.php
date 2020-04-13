<?php


namespace DisplayWebsiteEnitres;

require_once './autoFileImporter.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;


class DisplayWebsiteEnitres {

	protected $database;
	protected $dbname;

	public function __construct() {
		$acc      = ServiceAccount::fromJsonFile( __DIR__ . '/secret/valkyrie-17a63-firebase-adminsdk-8nsfp-f6e303d524.json' );
		$firebase = ( new Factory )->withServiceAccount( $acc )->create();
		$this->database = $firebase->getDatabase();
	}

	private function setDbName($name){
		if(isset($name) || !empty($name)){
			$this->dbname = $name;
		}
	}

	public function getPingInformation($url){
		$response = $this->makePingCall($url);
		return $response;
	}

	private function makePingCall($url){
		$curl = curl_init();
		$userAgent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31' ;


		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_USERAGENT => $userAgent,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
			),
		));

		$response = curl_exec($curl);
		$info = curl_getinfo($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		}
		$returnArray = [
			'response'  => $response,
			'info'      =>   $info
		];
		return $returnArray;
	}

	public function storeInformationInDB(){
		// TODO - make continual DB syncing for storing of past PING information
	}


}

$test = new DisplayWebsiteEnitres();
$fb = $test->getPingInformation('https://www.facebook.com/');


