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
use Sonata\ClassificationBundle\Model\ContextInterface;

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
        $parents = $this->findBy(['parent'=>['$exists'=>false]]);
        $res = [];
        foreach ($parents as $category) {
            $res[$category->getContext()->getId()][] = $category;
        }
        return $res;
    }

    public function getAllRootCategories(){
        return $this->findAll();
    }

    public function getRootCategoriesForContext(Context $context = null){
        return $this->findBy(['context.$id'=>$context->getId()]);
    }

    public function getRootCategoryWithChildren(CategoryInterface $category)
    {
        if (null === $category->getContext()) {
            throw new \RuntimeException('Context cannot be null');
        }
        if (null !== $category->getParent()) {
            throw new \RuntimeException('Method can be called only for root categories');
        }

        $context = $category->getContext();

        $this->loadCategories($context);

        foreach ($this->categories[$context->getId()] as $contextRootCategory) {
            if ($category->getId() === $contextRootCategory->getId()) {

                return $contextRootCategory;
            }
        }

        throw new \RuntimeException('Category does not exist');
    }

    /**
     * Load all categories from the database, the current method is very efficient for < 256 categories.
     */
    protected function loadCategories(ContextInterface $context)
    {
        if (\array_key_exists($context->getId(), $this->categories)) {
            return;
        }

        $class = $this->getClass();

        $categories = $this->findAll();

        if (0 === \count($categories)) {
            // no category, create one for the provided context
            $category = $this->create();
            $category->setName($context->getName());
            $category->setEnabled(true);
            $category->setContext($context);
            $category->setDescription($context->getName());

            $this->save($category);

            $categories = [$category];
        }

        $rootCategories = [];
        foreach ($categories as $pos => $category) {
            if (null === $category->getParent()) {
                $rootCategories[] = $category;
            }

            $this->categories[$context->getId()][$category->getId()] = $category;

            $parent = $category->getParent();

            $category->disableChildrenLazyLoading();

            if ($parent) {
                $parent->addChild($category);
            }
        }

        $this->categories[$context->getId()] = $rootCategories;

    }
}
