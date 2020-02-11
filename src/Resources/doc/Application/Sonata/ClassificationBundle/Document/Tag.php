<?php

namespace App\Application\Sonata\ClassificationBundle\Document;

use Sonata\ClassificationBundle\Document\BaseTag as BaseTag;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Tag extends BaseTag
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