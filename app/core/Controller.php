<?php

namespace App\Core;

/**
 * Base controller
 * Loads the models and views
 */
class Controller
{
    public function view($view, $data = [])
    {
        if (file_exists("../app/views/{$view}.php")) {
            require_once "../app/views/{$view}.php";
        } else {
            die('View does not exists');
        }
    }
}
