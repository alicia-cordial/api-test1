<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InterestRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;
/**
 * @ApiResource(
 * 
 *      normalizationContext={"groups"={"interest:read"}},
 *      denormalizationContext={"groups"={"interest:write"}},
 *      )
 * @ORM\Entity(repositoryClass=InterestRepository::class)
 */
class Interest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"interest:read", "experience:read", "user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * 
     * @Groups({"interest:read", "interest:write", "experience:read", "user:read"})
     */
    private $message;

    /**
     * @ORM\Column(type="boolean")
     * 
     * @Groups({"interest:read", "interest:write", "experience:read", "user:read"})
     */
    private $plan;

    /**
     * @ORM\Column(type="boolean")
     * 
     * @Groups({"interest:read", "interest:write", "experience:read", "user:read"})
     */
    private $accepted;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @Groups({"interest:read", "interest:write", "experience:read", "user:read"})
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="interests")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"interest:read", "interest:write", "experience:read", "user:read"})
     * @ApiProperty(readableLink=false)
     * 
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Experience::class, inversedBy="interests")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"interest:read", "interest:write", "user:read"})
     * @ApiProperty(readableLink=false)
     */
    private $experience;

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

    public function getPlan(): ?bool
    {
        return $this->plan;
    }

    public function setPlan(bool $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    public function getAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
}
