<?php
declare(strict_types=1);

namespace App\Model\Author;

use App\Model\Book\AbstractBookBuilder;

abstract class AbstractAuthorBuilder {
    private Author $result;

    public function reset(): AbstractAuthorBuilder {
        $this->result = new Author();
        return $this;
    }

    public function getResult(): Author {
        return $this->result;
    }

    public abstract function setAuthor(\stdClass $author): AbstractAuthorBuilder;
    public abstract function makeName(): AbstractAuthorBuilder;
    public abstract function makeBio(): AbstractAuthorBuilder;
    public abstract function makePictureUrl(): AbstractAuthorBuilder;
    public abstract function makeBirthDate(): AbstractAuthorBuilder;
    public abstract function makeDeathDate(): AbstractAuthorBuilder;
    public abstract function makeTrendyBooks(): AbstractAuthorBuilder;
}