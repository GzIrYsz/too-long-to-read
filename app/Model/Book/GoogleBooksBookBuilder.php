<?php

namespace App\Model\Book;

class GoogleBooksBookBuilder extends AbstractBookBuilder {

    public function makeTitle(): AbstractBookBuilder {
        return $this;
    }

    public function makeSummary(): AbstractBookBuilder {
        return $this;
    }

    public function makeAuthor(): AbstractBookBuilder {
        return $this;
    }

    public function makeEditor(): AbstractBookBuilder {
        return $this;
    }

    public function makePageCount(): AbstractBookBuilder {
        return $this;
    }

    public function makeReleaseDate(): AbstractBookBuilder {
        return $this;
    }

    public function makeThemes(): AbstractBookBuilder {
        return $this;
    }

    public function makeKind(): AbstractBookBuilder {
        return $this;
    }

    public function makeLanguage(): AbstractBookBuilder {
        return $this;
    }

    public function makeCoverUrl(): AbstractBookBuilder {
        return $this;
    }

    public function makeIds(): AbstractBookBuilder {
        return $this;
    }
}