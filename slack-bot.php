<?php

require_once('vendor/autoload.php');

use ReactEventLoopFactory;

$loop = ReactEventLoopFactory::create();

$client = new SlackRealTimeClient($loop);
$client->setToken('xoxb-1064737172918-1077642014132-u4O7K3uSDWsTmat4C3nAY51a');
$client->connect();

$loop->run();