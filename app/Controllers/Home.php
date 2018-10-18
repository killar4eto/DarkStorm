<?php

namespace App\Controllers;

use App\Extend\Controller;

class Home extends Controller
{
    public function index()
    {
        $data['language'] = $this->language->load('home');
        $this->view->forge('home/index', $data);
    }

    public function language($language)
    {
        $languages = array('english', 'bulgarian');
        if(in_array($language, $languages))
        {
            $_SESSION['language'] = $language;
            header('Location: /');
        }
        else
        {
            $data['error'][] = $this->language->translate('messages.language_not_defined');
        }
        $this->view->setData($data);
        $this->index();
    }
}