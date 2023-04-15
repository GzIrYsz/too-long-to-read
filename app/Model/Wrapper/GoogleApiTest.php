<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();

$client = new Google\Client();
$client->setApplicationName("Too Long To Read - Tests");
$client->setDeveloperKey($_ENV['GOOGLEAPI_TOKEN']);
$service = new Google\Service\Books($client);
$query = 'Harry Potter';
$optParams = [
    'filter' => 'free-ebooks'
];
$results = $service->volumes->listVolumes($query);

echo 'Total items : ' . $results->getTotalItems() . "\n";
$librarian = new \App\Model\Book\Librarian(new \App\Model\Book\GoogleApiBookBuilder());
$books = [];
foreach ($results->getItems() as $item) {
    $books[] = $librarian->makeBook($item);
    //var_dump($item['volumeInfo']);
    //break;
}

echo $books[0]->getTitle() . "\n";
echo $books[0]->getSummary() . "\n";
print_r($books[0]->getAuthors());
echo $books[0]->getEditor() . "\n";
echo $books[0]->getPageCount() . "\n";
echo $books[0]->getReleaseDate() . "\n";
echo $books[0]->getLanguage() . "\n";
print_r($books[0]->getIds());