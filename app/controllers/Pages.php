<?php

use App\Core\Controller;
use App\Models\Post;

class Pages extends Controller
{
    public function index()
    {
        $postModel = new Post();
        $posts = $postModel->getPosts();

        var_dump($posts);

        $this->view('pages/index', ['title' => 'Welcome!']);
    }

    public function about()
    {
        $this->view('pages/about', ['title' => 'About Us']);
    }
}
