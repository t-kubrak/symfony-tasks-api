<?php

namespace App\Entity\Sakila;

use Doctrine\ORM\Mapping as ORM;

/**
 * FilmText
 *
 * @ORM\Table(name="film_text", indexes={@ORM\Index(name="idx_title_description", columns={"title", "description"})})
 * @ORM\Entity
 */
class FilmText
{
    /**
     * @var int
     *
     * @ORM\Column(name="film_id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $filmId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    public function getFilmId(): ?int
    {
        return $this->filmId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


}
