<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\ClassificationBundle\Document;

use App\Application\Sonata\ClassificationBundle\Document\Context;
use Sonata\ClassificationBundle\Model\CategoryManagerInterface;
use Sonata\DatagridBundle\Pager\Doctrine\Pager;
use Sonata\DatagridBundle\ProxyQuery\Doctrine\ProxyQuery;
use Sonata\Doctrine\Document\BaseDocumentManager;

class CategoryManager extends BaseDocumentManager implements CategoryManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function findCategoryBy(array $criteria = null, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * {@inheritdoc}
     */
    public function getPager(array $criteria, $page, $limit = 10, array $sort = []): void
    {
        new \RuntimeException('method not implemented');
    }

    /**
     * @param Context $context|false
     */
    public function getRootCategoriesSplitByContexts($context){
        return [];
    }
}
