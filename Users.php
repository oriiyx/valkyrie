<?php


namespace Users;

require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Users {

	protected $database;
	protected $dbname = 'users';

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

	public function insert( array $data ) {
		if ( empty( $data ) || ! isset( $data ) ) {
			return false;
		}

		foreach ( $data as $key => $value ) {
			$this->database->getReference()->getChild( $this->dbname )->getChild( $key )->set( $value );
		}

		return true;
	}

	public function delete( int $userID ) {
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

$test = new Users();

/*var_dump($users->insert([
	'1' =>  'John',
	'2' =>  'Doe',
	'3' =>  'Pete',
	'4' =>  'Morty',
	'string'    =>  'Test Person'
]));*/

$test = $test->get('string');
var_dump($test);