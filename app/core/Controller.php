<?php

namespace App\Core;

/**
 * Base controller
 * Loads the models and views
 */
class Controller
{
    public function view($view, $data = [], $includeStructure = true)
    {
        if (file_exists("../app/views/{$view}.php")) {
            if ($includeStructure) {
                require_once APP_ROOT . '/views/inc/header.php';
            }

            require_once "../app/views/{$view}.php";

            if ($includeStructure) {
                require_once APP_ROOT . '/views/inc/footer.php';
            }
        } else {
            die('View does not exists');
        }
    }
}
