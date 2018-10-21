<?php

namespace App\Extend;

use Core\Classes\Controller as MainController;
use Core\Helpers\Language;

class Controller extends MainController
{
    protected $language = null;

    public function __construct()
    {
        session_start();
        parent::__construct();

        $this->language = new Language('english');

        if(isset($_SESSION['language']))
        {
            $this->language->set($_SESSION['language']);
        }

        $this->view->addData(array(
            'title' => $this->language->load('titles'),
            'language_menu' => $this->language->load('menu')
        ));
    }
    
}
