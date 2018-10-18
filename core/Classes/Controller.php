<?php
/*
 * This file is part of the Acher framework.
 *
 * (c) Atanas Harapov <atanas.harapov@abv.bg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Classes;

use Core\Helpers\Validation;
/**
 * Controller class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Controller 
{
    protected $input = null;
    protected $view = null;
    protected $layout = null;

    public function __construct()
    {
        $this->input = Input::getInstance();
        $this->view = new View();
        $this->view->setLayout($this->layout);
    }
}
