<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionsRepository::class)
 */
class Questions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToMany(targetEntity=Guests::class, inversedBy="questions")
     */
    private $related;

    public function __construct()
    {
        $this->related = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection|Guests[]
     */
    public function getRelated(): Collection
    {
        return $this->related;
    }

    public function addRelated(Guests $related): self
    {
        if (!$this->related->contains($related)) {
            $this->related[] = $related;
        }

        return $this;
    }

    public function removeRelated(Guests $related): self
    {
        $this->related->removeElement($related);

        return $this;
    }
}
