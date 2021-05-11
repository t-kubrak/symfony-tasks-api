<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LabelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=LabelRepository::class)
 */
class Label
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=TaskLabel::class, mappedBy="label")
     */
    private $taskLabels;

    public function __construct()
    {
        $this->taskLabels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|TaskLabel[]
     */
    public function getTaskLabels(): Collection
    {
        return $this->taskLabels;
    }

    public function addTaskLabel(TaskLabel $taskLabel): self
    {
        if (!$this->taskLabels->contains($taskLabel)) {
            $this->taskLabels[] = $taskLabel;
            $taskLabel->setLabel($this);
        }

        return $this;
    }

    public function removeTaskLabel(TaskLabel $taskLabel): self
    {
        if ($this->taskLabels->removeElement($taskLabel)) {
            // set the owning side to null (unless already changed)
            if ($taskLabel->getLabel() === $this) {
                $taskLabel->setLabel(null);
            }
        }

        return $this;
    }
}
