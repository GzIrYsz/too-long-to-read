<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

define("GOOGLEAPI_KEY", getenv('GOOGLEAPI_TOKEN'));

$client = new Google\Client();
$client->setApplicationName("Client_Library_Examples");
$client->setDeveloperKey(GOOGLEAPI_KEY);

$service = new Google\Service\Books($client);
$query = 'Harry Potter';
$optParams = [
    'filter' => 'free-ebooks'
];
$results = $service->volumes->listVolumes($query, $optParams);

echo 'Total items : ' . $results->getTotalItems() . "\n";

foreach ($results->getItems() as $item) {
    echo $item['volumeInfo']['title'] . "\n";
}