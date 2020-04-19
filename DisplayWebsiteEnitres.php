<?php


namespace DisplayWebsiteEnitres;

require_once './autoFileImporter.php';


class DisplayWebsiteEnitres {
	// Database Connection property
	public $firebaseConnection;

	public function __construct() {
		$this->firebaseConnection = ( new \Firestore( 'website-entries' ) );
	}

	/**
	 * @param $url
	 *
	 * @return array
	 */
	private function getPingInformation( $url ) {
		return $this->makePingCall( $url );
	}

	/**
	 * @param $url
	 *
	 * @return array
	 */
	private function makePingCall( $url ) {
		$curl      = curl_init();
		$userAgent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31';


		curl_setopt_array( $curl, [
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_USERAGENT      => $userAgent,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => "GET",
			CURLOPT_HTTPHEADER     => [
				"cache-control: no-cache",
			],
		] );

		$response = curl_exec( $curl );
		$info     = curl_getinfo( $curl );
		$err      = curl_error( $curl );

		curl_close( $curl );

		return $info;
	}

	/**
	 * @return array
	 */
	private function getInformationFromAllEntries() {
		$website_entries = $this->firebaseConnection->getCollection( 'website-entries' );
		$websiteIds      = [];
		$info            = [];
		foreach ( $website_entries->documents() as $item ) {
			$websiteIds[] = $item->id();
		}
		foreach ( $websiteIds as $id ) {
			$document = $this->firebaseConnection->getDocument( $id );
			$info[]   = [
				'ping-info'    => $this->getPingInformation( $document['website-url'] ),
				'website-info' => $document['website-name'],
			];
		}

		return $info;
	}

	public function displayInformationFromAllEntries() {
		$data         = $this->getInformationFromAllEntries();
		$return_array = [];
		foreach ( $data as $entry ) {
			$name           = $entry['website-info'];
			$ping_code      = $entry['ping-info']['http_code'];
			$url            = $entry['ping-info']['url'];
			$db_entry       = strtolower( str_replace( " ", "-", $entry['website-info'] ) );
			$return_array[] = [
				'name'      => $name,
				'ping_code' => $ping_code,
				'url'       => $url,
				'db-entry'  => $db_entry
			];
		}

		return $return_array;
	}


	/**
	 * @return array
	 */
	public function getInformationFromAllRecords() {
		$website_entries = $this->firebaseConnection->getCollection( 'data-records' );
		$websiteIds      = [];
		$info            = [];
		foreach ( $website_entries->documents() as $item ) {
			$websiteIds[] = $item->id();
		}
		foreach ( $websiteIds as $id ) {
			$document = $this->firebaseConnection->getDocument( $id );
			foreach ( $document as $time => $item ) {
				$time_and_date = date("Y-m-d h:i:s", $time);
				if($time_and_date != false){
					$info[$id][]   = [
						'time'          =>  $time_and_date,
						'status'        =>  $item
					];
				}
			}
		}

		return $info;
	}


}


