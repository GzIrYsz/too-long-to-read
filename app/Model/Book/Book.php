<?php
declare(strict_types=1);

namespace App\Model\Book;

class Book {
    private string $title;
    private string $summary;
    private array $authors;
    private string $editor;
    private int $pageCount;
    private string $releaseDate;
    private array $themes;
    private string $kind;
    private string $language;
    private string $coverUrl;
    private array $ids;
    private string $bookAuthorPageUrl;
    private string $gId;

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void {
        $this->title = $title ?? '';
    }

    /**
     * @return string
     */
    public function getSummary(): string {
        return $this->summary;
    }

    /**
     * @param string|null $summary
     */
    public function setSummary(?string $summary): void {
        $this->summary = $summary ?? '';
    }

    /**
     * @return array
     */
    public function getAuthors(): array {
        return $this->authors;
    }

    /**
     * @param array $authors
     */
    public function setAuthor(array $authors): void {
        $this->authors = $authors;
    }

    /**
     * @param string|null $author
     */
    public function addAuthor(?string $author): void {
        $this->authors[] = $author ?? '';
    }

    /**
     * @return string
     */
    public function getEditor(): string {
        return $this->editor;
    }

    /**
     * @param string|null $editor
     */
    public function setEditor(?string $editor): void {
        $this->editor = $editor ?? '';
    }

    /**
     * @return int
     */
    public function getPageCount(): int {
        return $this->pageCount;
    }

    /**
     * @param string|null $pageCount
     */
    public function setPageCount(?int $pageCount): void {
        $this->pageCount = $pageCount ?? 0;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string {
        return $this->releaseDate;
    }

    /**
     * @param string|null $releaseDate
     */
    public function setReleaseDate(?string $releaseDate): void {
        $this->releaseDate = $releaseDate ?? '';
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
     * @param string|null $language
     */
    public function setLanguage(?string $language): void {
        $this->language = $language ?? '';
    }

    /**
     * @return string
     */
    public function getCoverUrl(): string {
        return $this->coverUrl;
    }

    /**
     * @param string|null $coverUrl
     */
    public function setCoverUrl(?string $coverUrl): void {
        $this->coverUrl = $coverUrl ?? '';
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

    /**
     * @param string|null $key
     * @param string|null $id
     */
    public function addId(?string $key, ?string $id): void {
        $this->ids[$key] = $id ?? '';
    }

    /**
     * @return string
     */
    public function getBookAuthorPageUrl(): string {
        return $this->bookAuthorPageUrl;
    }

    /**
     * @param string $bookAuthorPageUrl
     */
    public function setBookAuthorPageUrl(string $bookAuthorPageUrl): void {
        $this->bookAuthorPageUrl = $bookAuthorPageUrl;
    }

    /**
     * @return string
     */
    public function getGId(): string {
        return $this->gId;
    }

    /**
     * @param string $gId
     */
    public function setGId(string $gId): void {
        $this->gId = $gId;
    }
}