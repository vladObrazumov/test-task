<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 */
class Document
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var Catalog
     *
     * @ORM\ManyToOne(targetEntity="Catalog", inversedBy="documents")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $catalog;

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

    public function getCatalog(): Catalog
    {
        return $this->catalog;
    }

    public function setCatalog(Catalog $catalog): void
    {
        $this->catalog = $catalog;
    }
}
