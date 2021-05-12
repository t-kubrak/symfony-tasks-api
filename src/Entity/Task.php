<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
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
     * @ORM\ManyToOne(targetEntity=Board::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $board;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=TaskLabel::class, mappedBy="task")
     */
    private $taskLabels;

    /**
     * @ORM\ManyToMany(targetEntity=MediaObject::class, inversedBy="tasks")
     */
    private $file;

    public function __construct()
    {
        $this->taskLabels = new ArrayCollection();
        $this->file = new ArrayCollection();
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

    public function getBoard(): ?Board
    {
        return $this->board;
    }

    public function setBoard(?Board $board): self
    {
        $this->board = $board;

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
            $taskLabel->setTask($this);
        }

        return $this;
    }

    public function removeTaskLabel(TaskLabel $taskLabel): self
    {
        if ($this->taskLabels->removeElement($taskLabel)) {
            // set the owning side to null (unless already changed)
            if ($taskLabel->getTask() === $this) {
                $taskLabel->setTask(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MediaObject[]
     */
    public function getFile(): Collection
    {
        return $this->file;
    }

    public function addFile(MediaObject $file): self
    {
        if (!$this->file->contains($file)) {
            $this->file[] = $file;
        }

        return $this;
    }

    public function removeFile(MediaObject $file): self
    {
        $this->file->removeElement($file);

        return $this;
    }
}
