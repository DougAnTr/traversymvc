<?php


namespace App\Models;

use App\Core\Model;

class Post extends Model
{
    public function getPosts(): array
    {
        $this->query('SELECT * FROM posts');

        return $this->results();
    }
}