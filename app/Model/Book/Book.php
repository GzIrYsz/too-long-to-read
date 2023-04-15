<?php
declare(strict_types=1);

namespace App\Model\Book;

class Book {
    private string $title;
    private string $summary;
    private string $author;
    private string $editor;
    private int $pageCount;
    private string $releaseDate;
    private array $themes;
    private string $kind;
    private string $language;
    private string $coverUrl;
    private array $ids;

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSummary(): string {
        return $this->summary;
    }

    /**
     * @param string $summary
     */
    public function setSummary(string $summary): void {
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getAuthor(): string {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getEditor(): string {
        return $this->editor;
    }

    /**
     * @param string $editor
     */
    public function setEditor(string $editor): void {
        $this->editor = $editor;
    }

    /**
     * @return int
     */
    public function getPageCount(): int {
        return $this->pageCount;
    }

    /**
     * @param int $pageCount
     */
    public function setPageCount(int $pageCount): void {
        $this->pageCount = $pageCount;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string {
        return $this->releaseDate;
    }

    /**
     * @param string $releaseDate
     */
    public function setReleaseDate(string $releaseDate): void {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return array
     */
    public function getThemes(): array {
        return $this->themes;
    }

    /**
     * @param array $themes
     */
    public function setThemes(array $themes): void {
        $this->themes = $themes;
    }

    /**
     * @return string
     */
    public function getKind(): string {
        return $this->kind;
    }

    /**
     * @param string $kind
     */
    public function setKind(string $kind): void {
        $this->kind = $kind;
    }

    /**
     * @return string
     */
    public function getLanguage(): string {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getCoverUrl(): string {
        return $this->coverUrl;
    }

    /**
     * @param string $coverUrl
     */
    public function setCoverUrl(string $coverUrl): void {
        $this->coverUrl = $coverUrl;
    }

    /**
     * @return array
     */
    public function getIds(): array {
        return $this->ids;
    }

    /**
     * @param array $ids
     */
    public function setIds(array $ids): void {
        $this->ids = $ids;
    }


}