<?php

require_once './autoFileImporter.php';

if ( isset( $_POST['entryWebsiteId'] ) ) {
	$entry_to_delete =  $_POST['entryWebsiteId'];

	$firestoreConnection = new Firestore();
	$firestoreConnection->setCollectionName( 'website-entries' );
	$firestoreConnection->removeDocument($entry_to_delete);
	$firestoreConnection->setCollectionName('data-records');
	$firestoreConnection->removeDocument($entry_to_delete);

}