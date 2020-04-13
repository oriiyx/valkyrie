<?php


namespace WebsiteEntries;

require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class WebsiteEntries {

	protected $database;
	protected $dbname = 'website-entries';

	public function __construct() {
		$acc      = ServiceAccount::fromJsonFile( __DIR__ . '/secret/valkyrie-17a63-firebase-adminsdk-8nsfp-f6e303d524.json' );
		$firebase = ( new Factory )->withServiceAccount( $acc )->create();

		$this->database = $firebase->getDatabase();
	}

	public function get( $userID = null ) {
		if ( empty( $userID ) || ! isset( $userID ) ) {
			return false;
		}

		if ( $this->database->getReference( $this->dbname )->getSnapshot()->hasChild( $userID ) ) {
			return $this->database->getReference( $this->dbname )->getChild( $userID )->getValue();
		} else {
			return false;
		}
	}

	public function getAllEntries() {
		if ( $this->database->getReference( $this->dbname )->getSnapshot()) {
			return $this->database->getReference($this->dbname)->getSnapshot()->getValue();
		}else{
			return false;
		}
	}

	public function insert( array $data ) {
		if ( empty( $data ) || ! isset( $data ) ) {
			return false;
		}

		foreach ( $data as $key => $value ) {
			$this->database->getReference()->getChild( $this->dbname )->getChild( $key )->set( $value );
		}

		return true;
	}

	public function delete( $userID ) {
		if ( empty( $userID ) || ! isset( $userID ) ) {
			return false;
		}

		if ( $this->database->getReference( $this->dbname )->getSnapshot()->hasChild( $userID ) ) {
			$this->database->getReference( $this->dbname )->getChild( $userID )->remove();

			return true;
		} else {
			return false;
		}
	}
}