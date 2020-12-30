<?php

use App\Core\Controller;
use App\Models\Post;

class Pages extends Controller
{
    public function index()
    {
        $postModel = new Post();

        $postModel->insertPost();

        $posts = $postModel->getPosts();

        $post = $postModel->getPostById(2);

        echo "<pre>";
        print_r($post);
        echo "</pre>";

        echo "<pre>";
        print_r($posts);
        echo "</pre>";

        $this->view('pages/index', ['title' => 'Welcome!']);
    }

    public function about()
    {
        $this->view('pages/about', ['title' => 'About Us']);
    }
}
