<?php

namespace App\Service;

use App\Entity\Catalog;
use Doctrine\ORM\EntityManagerInterface;

class CatalogManager
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(DocumentManager $documentManager, EntityManagerInterface $entityManager)
    {
        $this->documentManager = $documentManager;
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     * @return Catalog
     */
    public function createCatalogFromPureData(array $data): Catalog
    {
        $catalog = new Catalog();
        $catalog->setName($data['catalog_name']);
        $catalog->setId((int)$data['identity']); //i am not sure here because we don't know what expect from API

        if (array_key_exists('documents', $data)) {
            foreach ($data['documents'] as $documentData) {
                $catalog->addDocument($this->documentManager->createDocumentFromPureData($documentData));
            }
        }

        if (array_key_exists('catalogs', $data)) {
            foreach ($data['catalogs'] as $catalogData) {
                $catalog->addChild($this->createCatalogFromPureData($catalogData));
            }
        }

        $this->entityManager->persist($catalog);
        return $catalog;
    }

    /**
     * @param array $catalogsData
     */
    public function createCatalogsFromPureData(array $catalogsData): void
    {
        foreach ($catalogsData as $catalogData) {
            $this->createCatalogFromPureData($catalogData);
        }

        $this->entityManager->flush();
    }
}
