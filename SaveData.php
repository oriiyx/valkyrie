<?php

require_once '/home/paravinj/public_html/valkyrie/autoFileImporter.php';

class SaveData extends Firestore {

	protected $data;
	public function __construct( string $collection = '' ) {
		parent::__construct( $collection );
		$this->data = (new \DisplayWebsiteEnitres\DisplayWebsiteEnitres())->displayInformationFromAllEntries();
	}

	public function save_data(){
		foreach ( $this->data as $entry ) {
			$entry_name = strtolower( str_replace( " ", "-",  $entry['name'] ) );
			$time = time();
			$this->newDocumentEntry($entry_name, [
				'website-name'  =>  $entry['name'],
				$time  => $entry['ping_code']
			]);
		}
	}

	public function setWebsiteName(){

	}
}

$newData = new SaveData();
$newData->setCollectionName('data-records');
$data = $newData->save_data();