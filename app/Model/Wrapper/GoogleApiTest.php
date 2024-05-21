<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
//$dotenv->load();

$client = new Google\Client();
$client->setApplicationName("Too Long To Read - Tests");
$client->setDeveloperKey($_ENV['GOOGLEAPI_TOKEN']);
$service = new Google\Service\Books($client);
$query = 'Harry Potter';
$optParams = [
    'startIndex' => 900
];
$results = $service->volumes->listVolumes($query, $optParams);

print_r($results->getItems());