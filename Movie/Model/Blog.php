<?php

namespace Magenest\Movie\Model;

use Magenest\Movie\Api\Data\BlogInterface;
use Magento\Eav\Model\Attribute\Data\Date;
use Magento\Framework\Model\AbstractExtensibleModel;

class Blog extends AbstractExtensibleModel implements BlogInterface
{
    const ID = 'id';
    const IDAUTHOR = 'author_id';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const CONTENT = 'content';
    const URLREWRITE = 'url_rewrite';
    const STATUS = 'status';
    const CREATE_AT = 'create_at';
    const UPDATE_AT = 'update_at';

    protected $_eventPrefix = 'blog';

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\ResourceModel\Blog');
    }

    /**
     * @inerhitDoc
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inerhitDoc
     */
    public function setId($id)
    {
        $this->setData(self::ID, $id);
        return $this;
    }

    /**
     * @inerhitDoc
     */
    public function getAuthor()
    {
        return $this->getData(self::IDAUTHOR);
    }

    /**
     * @inerhitDoc
     */
    public function setAuthor($author_id)
    {
        $this->setData(self::IDAUTHOR, $author_id);
        return $this;
    }

    /**
     * @inerhitDoc
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inerhitDoc
     */
    public function setTitle($title)
    {
        $this->setData(self::TITLE, $title);
        return $this;
    }

    /**
     * @inerhitDoc
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @inerhitDoc
     */
    public function setDescription($description)
    {
        $this->setData(self::DESCRIPTION, $description);
        return $this;
    }

    /**
     * @inerhitDoc
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @inerhitDoc
     */
    public function setContent($content)
    {
        $this->setData(self::CONTENT, $content);
        return $this;
    }

    /**
     * @inerhitDoc
     */
    public function getUrlRewrite()
    {
        return $this->getData(self::URLREWRITE);
    }

    /**
     * @inerhitDoc
     */
    public function setUrlRewrite($url_rewrite)
    {
        $this->setData(self::URLREWRITE, $url_rewrite);
        return $this;
    }

    /**
     * @inerhitDoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inerhitDoc
     */
    public function setStatus($status)
    {
        $this->setData(self::STATUS, $status);
        return $this;
    }

    /**
     * @inerhitDoc
     */
    public function getCreateAt()
    {
        return $this->getData(self::CREATE_AT);
    }

    /**
     * @inerhitDoc
     */
    public function setCreateAt($create_at)
    {
        $this->setData(self::CREATE_AT, $create_at);
        return $this;
    }

    /**
     * @inerhitDoc
     */
    public function getUpdateAt()
    {
        return $this->getData(self::UPDATE_AT);
    }

    /**
     * @inerhitDoc
     */
    public function setUpdateAt($update_at)
    {
        $this->setData(self::UPDATE_AT, $update_at);
        return $this;
    }
}
