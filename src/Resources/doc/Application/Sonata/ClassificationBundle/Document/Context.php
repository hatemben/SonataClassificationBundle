<?php

namespace App\Application\Sonata\ClassificationBundle\Document;

use Sonata\ClassificationBundle\Document\BaseContext as BaseContext;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Context extends BaseContext
{
    /**
     * @MongoDB\Id(strategy="NONE")
     */
    protected $id;


}