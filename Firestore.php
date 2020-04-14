<?php

require_once 'vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

class Firestore {

	protected $db;
	protected $name = '';

	public function __construct( string $collection = '' ) {
		$this->db = new FirestoreClient( [
			'projectId' => 'valkyrie-17a63',
		] );

		$this->name = $collection;
	}

	/**
	 * @param string $name
	 *
	 * @return array|string|null
	 */
	public function getDocument( string $name ) {
		try {
			if ( $this->db->collection( $this->name )->document( $name )->snapshot()->exists() ) {
				return $this->db->collection( $this->name )->document( $name )->snapshot()->data();
			} else {
				throw new Exception( 'Document does not exist' );
			}

		} catch ( Exception $exception ) {
			return $exception->getMessage();
		}
	}

	public function getCollection( string $name, string $fieldName = 'website-name' ) {
		try {
			return $this->db->collection($name)->where($fieldName, '>', '');
		} catch ( Exception $exception ) {
			return $exception->getMessage();
		}
	}


	/**
	 * @param string $name
	 */
	public function setCollectionName( string $name ) {
		$this->name = $name;
	}

	/**
	 * @param string $field
	 * @param string $operator
	 * @param $value
	 *
	 * @return array
	 */
	public function getWhere( string $field, string $operator, $value ) {

		$arr   = [];
		$query = $this->db->collection( $this->name )->where( $field, $operator, $value )->documents()->rows();

		if ( ! empty( $query ) ) {
			foreach ( $query as $item ) {
				$arr[ $item->id() ] = $item->data();
			}
		}

		return $arr;
	}

	/**
	 * @param string $name
	 * @param array $data
	 *
	 * @return bool|string
	 */
	public function newDocument( string $name, array $data = [] ) {
		try {
			$this->db->collection( $this->name )->document( $name )->create($data);

			return true;
		} catch ( Exception $exception ) {
			return $exception->getMessage();
		}
	}

	/**
	 * @param string $name
	 * @param array $data
	 *
	 * @return bool|string
	 */
	public function newDocumentEntry( string $name, array $data = [] ) {
		try {
			$this->db->collection( $this->name )->document( $name )->set($data);

			return true;
		} catch ( Exception $exception ) {
			return $exception->getMessage();
		}
	}

	/**
	 * @param string $name
	 *
	 * @return string
	 */
	public function removeDocument( string $name ) {
		try {
			$this->db->collection( $this->name )->document( $name )->delete();
		} catch ( Exception $exception ) {
			return $exception->getMessage();
		}
	}

	/**
	 * @param string $name
	 * @param string $doc_name
	 * @param array $data
	 *
	 * @return bool|string
	 */
	public function newCollection( string $name, string $doc_name, array $data = [] ) {
		try {
			$this->db->collection( $name )->document( $doc_name )->create( $data );

			return true;
		} catch ( Exception $exception ) {
			return $exception->getMessage();
		}
	}

	public function removeCollection( string $name, int $limit = 1 ) {
		$documents = $this->db->collection( $name )->limit( $limit )->documents();
		while ( ! $documents->isEmpty() ) {
			foreach ( $documents as $item ) {
				$item->reference()->delete();
			}
		}
	}

	/**
	 * @param string $name
	 * @param int $limit
	 *
	 * @return bool
	 */
	public function checkIfCollectionExists( string $name, int $limit = 1 ) {
		$check = $this->db->collection( $name )->limit( $limit )->documents();

		return ! $check->isEmpty();
	}


}