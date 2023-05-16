<?php declare(strict_types=1);

namespace Macademy\Blog\Model;

use Macademy\Blog\Api\Data\PostInterface;
use Macademy\Blog\Api\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface{

    public function save(PostInterface $post): PostInterface
    {
        // TODO: Implement save() method.
    }

    public function getById($id): PostInterface
    {
        // TODO: Implement getById() method.
    }

    public function delete(PostInterface $post)
    {
        // TODO: Implement delete() method.
    }

    public function deleteById($id): bool
    {
        // TODO: Implement deleteById() method.
    }
}
