<?php

namespace App\Model\Author;

use App\Model\Book\GoogleApiBookBuilder;
use App\Model\Book\Librarian;
use Dotenv\Dotenv;
use Google\Client;
use Google\Service\Books;

class OpenLibraryAuthorBuilder extends AbstractAuthorBuilder {
    private \stdClass $author;

    public function setAuthor(\stdClass $author): AbstractAuthorBuilder {
        //$key = max($author->docs)->key;
//        $key = $author->docs[0]->key;
//        $tmp = null;
//        $client = new OpenLibrary();
//        $client->getAuthorByOLID($key)
//            ->then(function (ResponseInterface $res) use (&$tmp) {
//                $tmp = $res->getBody()->getContents();
//            },
//            function (RequestException $e) {})
//            ->wait();
//        $this->author = json_decode($tmp);
        $this->author = $author;
        return $this;
    }

    public function makeName(): AbstractAuthorBuilder {
        $this->getResult()->setName($this->author->name);
        return $this;
    }

    public function makeBio(): AbstractAuthorBuilder {
        if ($this->author->bio instanceof \stdClass) {
            $this->getResult()->setBio($this->author->bio->value);
        } else {
            $this->getResult()->setBio($this->author->bio);
        }
        return $this;
    }

    public function makePictureUrl(): AbstractAuthorBuilder {
        $olid = explode('/', $this->author->key);
        $this->getResult()->setPictureUrl("https://covers.openlibrary.org/a/olid/" . end($olid) . "-L.jpg");
        return $this;
    }

    public function makeBirthDate(): AbstractAuthorBuilder {
        $this->getResult()->setBirthDate($this->author->birth_date);
        return $this;
    }

    public function makeDeathDate(): AbstractAuthorBuilder {
        $this->getResult()->setDeathDate($this->author->death_date);
        return $this;
    }

    public function makeTrendyBooks(): AbstractAuthorBuilder {
        //$dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
        //$dotenv->load();

        $client = new Client();
        $client->setApplicationName("Too Long To Read");
        $client->setDeveloperKey($_ENV['GOOGLEAPI_TOKEN']);
        $service = new Books($client);
        $query = '+inauthor:' . $this->author->name;
        $optParams = [
            'maxResults' => '5'
        ];
        $results = $service->volumes->listVolumes($query, $optParams);
        $librarian = new Librarian(new GoogleApiBookBuilder());
        foreach ($results->getItems() as $item) {
            $this->getResult()->addTrendyBook($librarian->makeBook($item));
        }
        return $this;
    }
}