<?php

namespace App\Service;

use App\Entity\Document;

class DocumentManager
{
    /**
     * @param array $data
     * @return Document
     */
    public function createDocumentFromPureData(array $data): Document
    {
        $document = new Document();
        $document->setName($data['doc_name']);
        return $document;
    }
}
