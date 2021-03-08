<?php

namespace App\Entity;

use App\Repository\DateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DateRepository::class)
 */
class Date
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endAt;

    /**
     * @ORM\ManyToMany(targetEntity=Travel::class, mappedBy="dates")
     */
    private $travels;

    /**
     * @ORM\Column(type="datetime",options={"default":"CURRENT_TIMESTAMP"})
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdatedAt;

    public function __construct()
    {
        $this->createdAt=new \DateTime();
        $this->travels = new ArrayCollection();
    }

    /**
     * @Groups({"travel_browse","travel_read"})
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @Groups({"travel_browse","travel_read"})
     */
    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }


    public function setStartAt(?\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * @Groups({"travel_browse","travel_read"})
     */

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * @return Collection|Travel[]
     */
    public function getTravels(): Collection
    {
        return $this->travels;
    }

    public function addTravel(Travel $travel): self
    {
        if (!$this->travels->contains($travel)) {
            $this->travels[] = $travel;
            $travel->addDate($this);
        }

        return $this;
    }

    public function removeTravel(Travel $travel): self
    {
        $this->travels->removeElement($travel);

        $travel->removeDate($this);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }
}
