<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReviewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;
/**
 * @ApiResource(
 *      normalizationContext={"groups"={"review:read"}},
 *      denormalizationContext={"groups"={"review:write"}},
 *      collectionOperations={
 *          "get",
 *          "post"={"security"="is_granted('ROLE_USER')"}
 *      },
 *      itemOperations={
 *          "get",
 *          "delete"={"security"="is_granted('delete', object)"}
 *     } 
 * 
 *)
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"review:read", "experience:read", "user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"review:read", "review:write", "experience:read", "user:read"})
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @Groups({"review:read", "experience:read", "user:read"})
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"review:read", "review:write", "experience:read", "user:read"})
     */
    private $rating;

    /**
     * @ORM\ManyToOne(targetEntity=Experience::class, inversedBy="reviews")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"review:read", "review:write"})
     */
    private $experience;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reviews")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"review:read", "review:write", "experience:read", "user:read"})
     * @ApiProperty(readableLink=false)
     */
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getExperience(): ?Experience
    {
        return $this->experience;
    }

    public function setExperience(?Experience $experience): self
    {
        $this->experience = $experience;

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
}
