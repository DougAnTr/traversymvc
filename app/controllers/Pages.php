<?php

use App\Core\Controller;
use App\Models\Post;

class Pages extends Controller
{
    public function index()
    {
        $this->view('pages/index', ['title' => 'Welcome!']);
    }

    public function about()
    {
        $this->view('pages/about', ['title' => 'About Us']);
    }
}
