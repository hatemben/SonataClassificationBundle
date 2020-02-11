<?php

namespace App\Application\Sonata\ClassificationBundle\Document;

use Sonata\ClassificationBundle\Document\BaseCategory as BaseCategory;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Category extends BaseCategory
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