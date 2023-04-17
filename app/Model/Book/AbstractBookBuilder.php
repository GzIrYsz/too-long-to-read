<?php
declare(strict_types=1);

namespace App\Model\Book;

use Google\Service\Books\Volume;

abstract class AbstractBookBuilder {
    private Book $result;

    public function reset(): AbstractBookBuilder {
        $this->result = new Book();
        return $this;
    }

    public function getResult(): Book {
        return $this->result;
    }

    public abstract function setVolume(Volume|array $volume): AbstractBookBuilder;
    public abstract function makeTitle(): AbstractBookBuilder;
    public abstract function makeSummary(): AbstractBookBuilder;
    public abstract function makeAuthor(): AbstractBookBuilder;
    public abstract function makeEditor(): AbstractBookBuilder;
    public abstract function makePageCount(): AbstractBookBuilder;
    public abstract function makeReleaseDate(): AbstractBookBuilder;
    public abstract function makeThemes(): AbstractBookBuilder;
    public abstract function makeKind(): AbstractBookBuilder;
    public abstract function makeLanguage(): AbstractBookBuilder;
    public abstract function makeCoverUrl(): AbstractBookBuilder;
    public abstract function makeIds(): AbstractBookBuilder;
}