<?php

namespace App\Controllers;

use App\Extend\Controller as Controller;
use App\Models\Picture;

class Pictures extends Controller
{
    private $picture = null;

    public function __construct()
    {
        parent::__construct();
        $this->picture = new Picture();
    }

    public function index()
    {
        $data['pictures'] = $this->picture->getAll();
        $this->view->forge('pictures/index', $data);
    }

    public function show(int $id) // gives error on PHP 5 works on PHP 7
    {
        $data['picture'] = $this->picture->findId($id);
        $this->view->forge('pictures/show', $data);
    }
    
    public function create()
    {
        $this->view->forge('pictures/create');
    }

    public function store()
    {
        if($this->input->method() === 'POST')
        {
            $title = filter_var($this->input->post('title'), FILTER_SANITIZE_STRING);
            $url = filter_var($this->input->post('url'), FILTER_SANITIZE_URL);
            
            if(filter_var($url, FILTER_VALIDATE_URL) === false)
            {
                $data['error'][] = $this->language->translate('messages.url_invalid');
            }
            if( ! isset($data['error']))
            {
                $this->picture->create($title, $url);
                $data['success'] = $this->language->translate('messages.picture_added');
            }
            $this->view->setData($data);
            $this->index();
        }
    }
    
    public function edit(int $id) // gives error on PHP 5 works on PHP 7
    {
        $picture = $this->picture->findId($id);
        if(empty($picture))
        {
            header('Location: /pictures');
        }
        $data['picture'] = $picture;
        $this->view->forge('pictures/edit', $data);
    }

    public function update(int $id) // gives error on PHP 5 works on PHP 7
    {
        if($this->input->method() === 'PUT')
        {
            $title = filter_var($this->input->post('title'), FILTER_SANITIZE_STRING);
            $url = filter_var($this->input->post('url'), FILTER_SANITIZE_URL);
            
            if(filter_var($url, FILTER_VALIDATE_URL) === false)
            {
                $data['error'][] = $this->language->translate('messages.url_invalid');
            }
            if( ! isset($data['error']))
            {
                $this->picture->update($id, $title, $url);
                $data['success'] = $this->language->translate('messages.picture_updated');
            }
            $this->view->setData($data);
            $this->edit($id);
        }
    }

    public function delete(int $id) // gives error on PHP 5 works on PHP 7
    {
        if($this->input->method() === 'DELETE')
        {
            $this->picture->delete($id);
            $data['success'] = $this->language->translate('messages.picture_deleted');
            $this->view->setData($data);
            $this->index();
        }
    }
}
