<?php

namespace Magenest\Movie\Model;

use Magenest\Movie\Api\Data\BlogInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class BlogRepository implements \Magenest\Movie\Api\BlogRepositoryInterface
{
    protected $blogFactory;
    protected $blogResource;

    /**
     * @param BlogFactory $blogFactory
     * @param ResourceModel\Blog $blogResource
     */
    public function __construct(
        \Magenest\Movie\Model\BlogFactory        $blogFactory,
        \Magenest\Movie\Model\ResourceModel\Blog $blogResource
    ) {
        $this->blogFactory = $blogFactory;
        $this->blogResource = $blogResource;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        $blogModel = $this->blogFactory->create();
        $this->blogResource->load($blogModel, $id);
        if (!$blogModel->getId()) {
            throw new NoSuchEntityException(__('Unable to find custom data with ID "%1"', $id));
        }
        return $blogModel;
    }

    /**
     * @param BlogInterface $blog
     * @return BlogInterface|ResourceModel\Blog
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(BlogInterface $blog)
    {
        return $this->blogResource->save($blog);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteById($id)
    {
        try {
            $blogModel = $this->blogFactory->create();
            $this->blogResource->load($blogModel, $id);
            $this->blogResource->delete($blogModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }
        return true;
    }
}
