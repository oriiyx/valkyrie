<?php

use WebsiteEntries\WebsiteEntries;

require_once './WebsiteEntries.php';

$urls = $_POST['website-url'];
$names = $_POST['website-name'];

$count = count($_POST['website-url']);
for($i=0; $i < $count; $i++){
	$entry = new WebsiteEntries();
	$entry->insert([
		$names[$i]   =>  $urls[$i]
	]);
	echo $names[$i] . 'has been added to your watchlist';
	echo $urls[$i] . 'has been added to your watchlist';
}