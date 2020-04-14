<?php


namespace DisplayWebsiteEnitres;

require_once './autoFileImporter.php';


class DisplayWebsiteEnitres {
	protected $firebaseConnection;

	public function __construct() {
		$this->firebaseConnection = ( new \Firestore( 'website-entries' ) );
	}

	public function getPingInformation( $url ) {
		return $this->makePingCall( $url );
	}

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

		if ( $err ) {
			echo "cURL Error #:" . $err;
		}

		return [
//			'response' => $response,
			'info' => $info,
		];

	}

	public function storeInformationInDB() {
		// TODO - make continual DB syncing for storing of past PING information
	}

	/**
	 * @return array
	 */
	public function getInformationFromAllEntries() {
		$website_entries = $this->firebaseConnection->getCollection( 'website-entries' );
		$websiteIds      = [];
		$info            = [];
		foreach ( $website_entries->documents() as $item ) {
			$websiteIds[] = $item->id();
		}
		foreach ( $websiteIds as $id ) {
			$document = $this->firebaseConnection->getDocument( $id );
			$info[]   = $this->getPingInformation( $document['website-url'] );
		}

		return $info;
	}


}

$test = new DisplayWebsiteEnitres();
$info = $test->getInformationFromAllEntries();
var_dump( $info );


