<?php
declare(strict_types=1);

namespace App\Model\Book;

use Google\Service\Books\Volume;

class Librarian {
    private AbstractBookBuilder $builder;

    public function __construct(AbstractBookBuilder $builder) {
        $this->builder = $builder;
    }

    public function makeBook(Volume $volume): Book {
        $this->builder->setVolume($volume);
        return $this->builder->reset()
            ->makeTitle()
            ->makeSummary()
            ->makeAuthor()
            ->makeEditor()
            ->makePageCount()
            ->makeReleaseDate()
            ->makeThemes()
            ->makeKind()
            ->makeLanguage()
            ->makeCoverUrl()
            ->makeIds()
            ->getResult();
    }
}