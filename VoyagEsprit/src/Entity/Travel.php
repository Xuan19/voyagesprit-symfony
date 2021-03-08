<?php

namespace App\Entity;

use App\Repository\TravelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=TravelRepository::class)
 */
class Travel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $program;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $is_liked;

    /**
     * @ORM\Column(type="datetime",options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $display_homepage;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $image = [];

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $price_details;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $baseline;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="travel", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="travels")
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=Date::class, inversedBy="travels")
     */
    private $dates;

    /**
     * @ORM\ManyToMany(targetEntity=City::class, mappedBy="travels")
     */
    private $cities;

    public function __construct()
    {
        $this->createdAt=new \DateTime();
        $this->comments = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->dates = new ArrayCollection();
        $this->cities = new ArrayCollection();
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
     * @Groups({"travel_read"})
     */

    public function getProgram(): ?string
    {
        return $this->program;
    }

    public function setProgram(string $program): self
    {
        $this->program = $program;

        return $this;
    }

     /**
     * @Groups({"travel_browse","travel_read"})
     */

    public function getIsLiked(): ?bool
    {
        return $this->is_liked;
    }

    public function setIsLiked(bool $is_liked): self
    {
        $this->is_liked = $is_liked;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @Groups({"travel_browse"})
     */

    public function getDisplayHomepage(): ?bool
    {
        return $this->display_homepage;
    }

    public function setDisplayHomepage(bool $display_homepage): self
    {
        $this->display_homepage = $display_homepage;

        return $this;
    }

    /**
     * @Groups({"travel_browse","travel_read"})
     */

    public function getImage(): ?array
    {
        return $this->image;
    }

    public function setImage(?array $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @Groups({"travel_browse","travel_read"})
     */

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

     /**
     * @Groups({"travel_read"})
     */


    public function getPriceDetails(): ?string
    {
        return $this->price_details;
    }

    public function setPriceDetails(?string $price_details): self
    {
        $this->price_details = $price_details;

        return $this;
    }

    /**
     * @Groups({"travel_browse","travel_read"})
     */

    public function getBaseline(): ?string
    {
        return $this->baseline;
    }

    public function setBaseline(?string $baseline): self
    {
        $this->baseline = $baseline;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     * @Groups({"travel_read"})
     */
    
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setTravel($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getTravel() === $this) {
                $comment->setTravel(null);
            }
        }

        return $this;
    }

    /**
     * @Groups({"travel_browse","travel_read"})
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addTravel($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeTravel($this);
        }

        return $this;
    }

    /**
     * @Groups({"travel_browse","travel_read"})
     * @return Collection|Date[]
     */
    public function getDates(): Collection
    {
        return $this->dates;
    }

    public function addDate(Date $date): self
    {
        if (!$this->dates->contains($date)) {
            $this->dates[] = $date;
            $date->addTravel($this);
        }

        return $this;
    }

    public function removeDate(Date $date): self
    {
        if ($this->dates->removeElement($date)) {
            $date->removeTravel($this);
        }

        return $this;
    }

    /**
     * @Groups({"travel_browse","travel_read"})
     * @return Collection|City[]
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
            $city->addTravel($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->cities->removeElement($city)) {
            $city->removeTravel($this);
        }

        return $this;
    }
}
