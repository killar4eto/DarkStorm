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

class Api
{
    protected $input = null;
    protected $view = null;
    protected $layout = null;
    protected $version = "0.1";

    public function __construct()
    {

    }

    public function getVersion(){
        return $this->version;
    }
}
