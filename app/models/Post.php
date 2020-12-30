<?php


namespace App\Models;

use App\Core\Model;

class Post extends Model
{
    public function getPosts(): array
    {
        $this->select('*');
        $this->from('posts');

        return $this->results();
    }

    public function getPostById($id): array
    {
        $this->select('*');
        $this->from('posts');
        $this->where('id', $id);

        return $this->results();
    }

    public function insertPost()
    {
        $this->insert('posts', ['title' => 'post-' . uniqid()]);
    }
}