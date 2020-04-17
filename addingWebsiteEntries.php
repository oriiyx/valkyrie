<?php

require_once './autoFileImporter.php';

if ( isset( $_POST['website-url'] ) && isset( $_POST['website-name'] ) ) {
	$urls  = $_POST['website-url'];
	$names = $_POST['website-name'];
	$count = count( $_POST['website-url'] );
} else {
	$count = 0;
}

if ( $count != 0 ) {

	$firestoreConnection = new Firestore();
	$doesCollectionExist = $firestoreConnection->checkIfCollectionExists( 'website-entries' );

	if ( ! $doesCollectionExist ) {
		$firestoreConnection->newCollection( 'website-entries', 'default-information' );
	}
	$firestoreConnection->setCollectionName( 'website-entries' );
}

for ( $i = 0; $i < $count; $i ++ ) {

	$name_tag = strtolower( str_replace( " ", "-", $names[ $i ] ) );
	$firestoreConnection->newDocument( $name_tag, [
		'website-name' => $names[ $i ],
		'website-url'  => $urls[ $i ],
	] );

	echo '<br>';
	echo $names[ $i ] . ' has been added to your watchlist';
}