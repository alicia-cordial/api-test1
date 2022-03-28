<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ExperienceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
/**
 * @ApiResource(
 *      attributes={"order"={"created_at": "DESC"}},
 *      normalizationContext={"groups"={"experience:read"}},
 *      denormalizationContext={"groups"={"experience:write"}},
 *      collectionOperations={
 *          "get",
 *          "post"={"security"="is_granted('ROLE_USER')"}
 *      },
 * 
 *      itemOperations={
 *          "get",
 *          "patch"={"security"="is_granted('edit', object)"},
 *          "delete"={"security"="is_granted('delete', object)"}
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"title" = "partial", "content" = "ipartial"})
 * @ApiFilter(BooleanFilter::class, properties={"archive", "visible"})
 * @ORM\Entity(repositoryClass=ExperienceRepository::class)
 */
class Experience
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"experience:read", "user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"experience:read", "experience:write", "interest:read", "user:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * 
     * @Groups({"experience:read", "experience:write", "interest:read", "user:read"})
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"experience:read", "experience:write", "user:read"})
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @Groups({"experience:read", "experience:write", "interest:read", "user:read"})
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     * @ApiFilter(SearchFilter::class, strategy="partial")
     * @Groups({"experience:read", "experience:write", "interest:read",  "user:read"})
     */
    private $location;

    /**
     * @ORM\Column(type="integer") 
     * @Groups({"experience:read", "experience:write", "user:read"})
      */
     #[ApiProperty(security: "is_granted('ROLE_USER')")]
    private $spots;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"experience:write", "experience:read"})
     */
    private $duration;

    /**
     * @ORM\Column(type="boolean")
     * 
     * @Groups({"experience:read", "experience:write", "user:read", "user:write"})
     */
    private $visible;

    /**
     * @ORM\Column(type="boolean")
     * 
     * @Groups({"experience:read", "experience:write", "user:read", "user:write"})
     */
    private $archive;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * @Groups("experience:read")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="experiences")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"experience:read"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="experience")
     * 
     * @Groups({"experience:read", "user:read"})
     */
    private $reviews;

    /**
     * @ORM\OneToMany(targetEntity=Interest::class, mappedBy="experience", orphanRemoval=true)
     * 
     * @Groups({"experience:read", "user:read"})
     */
    private $interests;

    public function __construct()
    {
        $this->archive = false;
        $this->created_at = new \DateTime('now');
        $this->reviews = new ArrayCollection();
        $this->interests = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getSpots(): ?int
    {
        return $this->spots;
    }

    public function setSpots(int $spots): self
    {
        $this->spots = $spots;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setExperience($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getExperience() === $this) {
                $review->setExperience(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Interest[]
     */
    public function getInterests(): Collection
    {
        return $this->interests;
    }

    public function addInterest(Interest $interest): self
    {
        if (!$this->interests->contains($interest)) {
            $this->interests[] = $interest;
            $interest->setExperience($this);
        }

        return $this;
    }

    public function removeInterest(Interest $interest): self
    {
        if ($this->interests->removeElement($interest)) {
            // set the owning side to null (unless already changed)
            if ($interest->getExperience() === $this) {
                $interest->setExperience(null);
            }
        }

        return $this;
    }


}
