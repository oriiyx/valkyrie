<?php
header('Content-Type: application/json');

use DisplayWebsiteEnitres\DisplayWebsiteEnitres;

require_once './autoFileImporter.php';

$entry = new \DisplayWebsiteEnitres\DisplayWebsiteEnitres();
$entry->firebaseConnection->setCollectionName('data-records');
$data = $entry->getInformationFromAllRecords();
echo json_encode($data);