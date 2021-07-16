<?php

namespace App\Entity;

use App\Repository\QuizzRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizzRepository::class)
 */
class Quizz
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Questions::class)
     */
    private $questions;

    /**
     * @ORM\OneToOne(targetEntity=Guests::class, inversedBy="quizz", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $guests;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Questions[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Questions $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
        }

        return $this;
    }

    public function removeQuestion(Questions $question): self
    {
        $this->questions->removeElement($question);

        return $this;
    }

    public function getGuests(): ?Guests
    {
        return $this->guests;
    }

    public function setGuests(Guests $guests): self
    {
        $this->guests = $guests;

        return $this;
    }
}
