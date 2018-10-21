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

require_once '../Helpers/vendor/autoload.php';

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
    protected $path_twig = "../resources/views";

    public function __construct()
    {
        $this->input = Input::getInstance();
        $this->view = new View();

        $loader = new Twig_Loader_Filesystem($this->path_twig);
        $twig = new Twig_Environment($loader, array(
            'cache' => '../resources/pages/cache',
        ));

        //echo $twig->render('index.html', array('name' => 'Fabien'));

        $this->view->setLayout($this->layout);
    }
}
