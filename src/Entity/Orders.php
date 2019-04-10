<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;
	
	public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placedby;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ordered;

    /**
     * @ORM\Column(type="integer")
     */
    private $total;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPlacedby(): ?string
    {
        return $this->placedby;
    }

    public function setPlacedby(string $placedby): self
    {
        $this->placedby = $placedby;

        return $this;
    }

    public function getOrdered(): ?string
    {
        return $this->ordered;
    }

    public function setOrdered(string $ordered): self
    {
        $this->ordered = $ordered;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
