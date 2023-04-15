<?php
declare(strict_types=1);

namespace App\Model\Book;

class Librarian {
    private AbstractBookBuilder $builder;

    public function __construct(AbstractBookBuilder $builder) {
        $this->builder = $builder;
    }

    public function makeBook(): Book {
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