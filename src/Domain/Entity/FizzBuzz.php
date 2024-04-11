<?php

namespace App\Domain\Entity;

use App\Domain\Repository\FizzBuzzRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FizzBuzzRepository::class)]
class FizzBuzz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private ?int $numberStart;

    #[ORM\Column(type: 'integer')]
    private ?int $numberEnd;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $fizzBuzzGenerated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getnumberStart(): ?int
    {
        return $this->numberStart;
    }

    public function setnumberStart(int $numberStart): self
    {
        $this->numberStart = $numberStart;

        return $this;
    }

    public function getnumberEnd(): ?int
    {
        return $this->numberEnd;
    }

    public function setnumberEnd(int $numberEnd): self
    {
        $this->numberEnd = $numberEnd;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFizzBuzzGenerated(): ?string
    {
        return $this->fizzBuzzGenerated;
    }

    public function setFizzBuzzGenerated(string $fizzBuzzGenerated): self
    {
        $this->fizzBuzzGenerated = $fizzBuzzGenerated;

        return $this;
    }
}
