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

use Core\Helpers\Database;
/**
 * Model class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Model
{
    protected $db = null;
    protected $input = null;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->input = Input::getInstance();
    }
}
