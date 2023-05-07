<?php

namespace App\Model\Author;

class AuthorDirector {
    private AbstractAuthorBuilder $builder;

    public function __construct(AbstractAuthorBuilder $builder) {
        $this->builder = $builder;
    }

    public function makeAuthor(\stdClass $author): Author {
        $this->builder->setAuthor($author);
        return $this->builder->reset()
            ->makeName()
            ->makeBio()
            ->makePictureUrl()
            ->makeBirthDate()
            ->makeDeathDate()
            ->makeTrendyBooks()
            ->getResult();
    }
}