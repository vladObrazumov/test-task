<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="App\Repository\CatalogRepository")
 */
class Catalog
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Document", mappedBy="catalog", cascade={"persist", "remove"})
     */
    private $documents;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer")
     */
    private $rgt;

    /**
     * @var Catalog
     *
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Catalog")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @var Catalog
     *
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Catalog", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Catalog", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
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

    public function getDocuments(): ArrayCollection
    {
        return $this->documents;
    }

    public function setDocuments(ArrayCollection $documents): self
    {
        $this->documents = $documents;

        return $this;
    }

    public function addDocument(Document $document): void
    {
        $this->documents->add($document);
        $document->setCatalog($this);
    }

    public function removeDocument(Document $document): void
    {
        $this->documents->remove($document);
    }

    public function getRoot(): ?Catalog
    {
        return $this->root;
    }

    public function setParent(Catalog $parent = null): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getParent(): Catalog
    {
        return $this->parent;
    }

    public function addChild(Catalog $child): void
    {
        $this->children->add($child);
        $child->setParent($this);
    }
}
