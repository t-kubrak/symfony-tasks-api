<?php

namespace App\Entity\Sakila;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Film
 *
 * @ORM\Table(name="film", indexes={@ORM\Index(name="idx_fk_language_id", columns={"language_id"}), @ORM\Index(name="idx_fk_original_language_id", columns={"original_language_id"}), @ORM\Index(name="idx_title", columns={"title"})})
 * @ORM\Entity(repositoryClass="App\Repository\Sakila\FilmRepository")
 */
class Film
{
    /**
     * @var int
     * @Groups("film")
     * @ORM\Column(name="film_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $filmId;

    /**
     * @var string
     * @Groups("film")
     * @ORM\Column(name="title", type="string", length=128, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     * @Groups("film")
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime|null
     * @Groups("film")
     * @ORM\Column(name="release_year", type="integer", nullable=true)
     */
    private $releaseYear;

    /**
     * @var bool
     * @Groups("film")
     * @ORM\Column(name="rental_duration", type="boolean", nullable=false, options={"default"="3"})
     */
    private $rentalDuration = '3';

    /**
     * @var string
     * @Groups("film")
     * @ORM\Column(name="rental_rate", type="decimal", precision=4, scale=2, nullable=false, options={"default"="4.99"})
     */
    private $rentalRate = '4.99';

    /**
     * @var int|null
     * @Groups("film")
     * @ORM\Column(name="length", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $length;

    /**
     * @var string
     * @Groups("film")
     * @ORM\Column(name="replacement_cost", type="decimal", precision=5, scale=2, nullable=false, options={"default"="19.99"})
     */
    private $replacementCost = '19.99';

    /**
     * @var string|null
     * @Groups("film")
     * @ORM\Column(name="rating", type="string", length=0, nullable=true, options={"default"="G"})
     */
    private $rating = 'G';

    /**
     * @var array|null
     * @Groups("film")
     * @ORM\Column(name="special_features", type="simple_array", length=0, nullable=true)
     */
    private $specialFeatures;

    /**
     * @var \DateTime
     * @Groups("film")
     * @ORM\Column(name="last_update", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';

    /**
     * @var \Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     * })
     */
    private $language;

    /**
     * @var \Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="original_language_id", referencedColumnName="language_id")
     * })
     */
    private $originalLanguage;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Actor", mappedBy="film")
     */
    private $actor;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="film")
     * @ORM\JoinTable(name="film_category",
     *   joinColumns={
     *     @ORM\JoinColumn(name="film_id", referencedColumnName="film_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
     *   }
     * )
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actor = new \Doctrine\Common\Collections\ArrayCollection();
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    public function getReleaseYear(): ?int
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(?int $releaseYear): self
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    public function getRentalDuration(): ?bool
    {
        return $this->rentalDuration;
    }

    public function setRentalDuration(bool $rentalDuration): self
    {
        $this->rentalDuration = $rentalDuration;

        return $this;
    }

    public function getRentalRate(): ?string
    {
        return $this->rentalRate;
    }

    public function setRentalRate(string $rentalRate): self
    {
        $this->rentalRate = $rentalRate;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getReplacementCost(): ?string
    {
        return $this->replacementCost;
    }

    public function setReplacementCost(string $replacementCost): self
    {
        $this->replacementCost = $replacementCost;

        return $this;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function setRating(?string $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getSpecialFeatures(): ?array
    {
        return $this->specialFeatures;
    }

    public function setSpecialFeatures(?array $specialFeatures): self
    {
        $this->specialFeatures = $specialFeatures;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(\DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getOriginalLanguage(): ?Language
    {
        return $this->originalLanguage;
    }

    public function setOriginalLanguage(?Language $originalLanguage): self
    {
        $this->originalLanguage = $originalLanguage;

        return $this;
    }

    /**
     * @return Collection|Actor[]
     */
    public function getActor(): Collection
    {
        return $this->actor;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actor->contains($actor)) {
            $this->actor[] = $actor;
            $actor->addFilm($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        if ($this->actor->removeElement($actor)) {
            $actor->removeFilm($this);
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

}
