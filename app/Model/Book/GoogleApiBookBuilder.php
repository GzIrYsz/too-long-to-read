<?php
declare(strict_types=1);

namespace App\Model\Book;

use Google\Service\Books\Volume;

class GoogleApiBookBuilder extends AbstractBookBuilder {
    private Volume $volume;

    public function setVolume(Volume|array $volume): AbstractBookBuilder {
        $this->volume = $volume;
        return $this;
    }

    public function makeTitle(): AbstractBookBuilder {
        $this->getResult()->setTitle($this->volume['volumeInfo']['title']);
        return $this;
    }

    public function makeSummary(): AbstractBookBuilder {
        $this->getResult()->setSummary(strip_tags($this->volume['volumeInfo']['description']));
        return $this;
    }

    public function makeAuthor(): AbstractBookBuilder {
        $authors = $this->volume['volumeInfo']['authors'];
        foreach ($authors as $author) {
            $this->getResult()->addAuthor($author);
        }
        return $this;
    }

    public function makeEditor(): AbstractBookBuilder {
        $this->getResult()->setEditor($this->volume['volumeInfo']['publisher']);
        return $this;
    }

    public function makePageCount(): AbstractBookBuilder {
        $this->getResult()->setPageCount($this->volume['volumeInfo']['pageCount']);
        return $this;
    }

    public function makeReleaseDate(): AbstractBookBuilder {
        $this->getResult()->setReleaseDate($this->volume['volumeInfo']['publishedDate']);
        return $this;
    }

    public function makeThemes(): AbstractBookBuilder {
        foreach ($this->volume['volumeInfo']['categories'] as $category) {
            $this->getResult()->addTheme($category);
        }
        return $this;
    }

    public function makeKind(): AbstractBookBuilder {
        return $this;
    }

    public function makeLanguage(): AbstractBookBuilder {
        $this->getResult()->setLanguage($this->volume['volumeInfo']['language']);
        return $this;
    }

    public function makeCoverUrl(): AbstractBookBuilder {
        $this->getResult()->setCoverUrl($this->volume['volumeInfo']['imageLinks']['thumbnail']);
        return $this;
    }

    public function makeIds(): AbstractBookBuilder {
        $ids = $this->volume['volumeInfo']['industryIdentifiers'];
        foreach ($ids as $id) {
            $type = $id['type'];
            $identifier = $id['identifier'];
            $this->getResult()->addId($type, $identifier);
        }
        return $this;
    }

    public function makeBookAuthorPageUrl(): AbstractBookBuilder {
        return $this;
    }

    public function makeGId(): AbstractBookBuilder {
        $this->getResult()->setGId($this->volume['id']);
        return $this;
    }
}