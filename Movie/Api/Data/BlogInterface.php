<?php

namespace Magenest\Movie\Api\Data;

use Magento\Eav\Model\Attribute\Data\Date;
use Magento\Framework\Api\ExtensibleDataInterface;

interface BlogInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getAuthor();

    /**
     * @param $author_id
     * @return $this
     */
    public function setAuthor($author_id);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param $content
     * @return $this
     */
    public function setContent($content);

    /**
     * @return string
     */
    public function getUrlRewrite();

    /**
     * @param $url_rewrite
     * @return $this
     */
    public function setUrlRewrite($url_rewrite);

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * @return Date
     */
    public function getCreateAt();

    /**
     * @param $create_at
     * @return $this
     */
    public function setCreateAt($create_at);

    /**
     * @return date
     */
    public function getUpdateAt();

    /**
     * @param $update_at
     * @return $this
     */
    public function setUpdateAt($update_at);
}
