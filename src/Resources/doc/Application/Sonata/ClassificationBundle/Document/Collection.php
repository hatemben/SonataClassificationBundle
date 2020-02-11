<?php

namespace App\Application\Sonata\ClassificationBundle\Document;

use Sonata\ClassificationBundle\Document\BaseCollection as BaseCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Collection extends BaseCollection
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument="App\Application\Sonata\ClassificationBundle\Document\Context")
     */
    protected $context;

}