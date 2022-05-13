<?php
namespace Magenest\Movie\Api;

use Magenest\Movie\Api\Data\BlogInterface;

interface BlogRepositoryInterface
{

    /**
     * @param int $id
     * @return BlogInterface
     */
    public function getById($id);

    /**
     * @param BlogInterface $blog
     * @return BlogInterface
     */
    public function save(BlogInterface $blog);

    /**
     * @param $id
     * @return bool
     */
    public function deleteById($id);

}
