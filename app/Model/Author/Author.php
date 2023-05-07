<?php
declare(strict_types=1);

namespace App\Model\Author;

use App\Model\Book\Book;

class Author {
    private string $name;
    private string $bio;
    private string $pictureUrl;
    private string $birthDate;
    private string $deathDate;
    private array $trendyBooks;

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBio(): string {
        return $this->bio;
    }

    /**
     * @param string|null $bio
     */
    public function setBio(?string $bio): void {
        $this->bio = $bio ?? '';
    }

    /**
     * @return string
     */
    public function getPictureUrl(): string {
        return $this->pictureUrl;
    }

    /**
     * @param string|null $pictureUrl
     */
    public function setPictureUrl(?string $pictureUrl): void {
        $this->pictureUrl = $pictureUrl ?? '';
    }

    /**
     * @return string
     */
    public function getBirthDate(): string {
        return $this->birthDate;
    }

    /**
     * @param string|null $birthDate
     */
    public function setBirthDate(?string $birthDate): void {
        $this->birthDate = $birthDate ?? '';
    }

    /**
     * @return string
     */
    public function getDeathDate(): string {
        return $this->deathDate;
    }

    /**
     * @param string|null $deathDate
     */
    public function setDeathDate(?string $deathDate): void {
        $this->deathDate = $deathDate ?? '';
    }

    /**
     * @return array
     */
    public function getTrendyBooks(): array {
        return $this->trendyBooks;
    }

    /**
     * @param array $trendyBooks
     */
    public function setTrendyBooks(array $trendyBooks): void {
        $this->trendyBooks = $trendyBooks;
    }

    /**
     * @param Book $book
     */
    public function addTrendyBook(Book $book): void {
        $this->trendyBooks[] = $book;
    }
}