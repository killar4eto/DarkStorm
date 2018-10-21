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
    protected $database = null;
    protected $table = null;

    public function __construct()
    {
        $this->db = new Database($this->database);
        $this->input = Input::getInstance();
    }

    public function all($addition = null)
    {
        $options = [
            'top' => 'TOP ',
            'order' => 'ORDER BY '
        ];
        $data = [];
        $string = 'SELECT [top] * FROM ' . $this->table . ' [order]';
        if(is_array($addition)) {
            foreach ($addition as $key => $option) {
                $value = $options[$key] . $option;
                $string = str_replace('[' . $key . ']', $value, $string);
            }
        }

        $string = preg_replace('/\[(.*)\]/', '', $string);

        $query = $this->db->prepare($string);
        $query->execute($data);
        return $query->fetchAll();
    }

    public function find($name, $value)
    {
        $query = $this->db->prepare("SELECT TOP 1 * FROM " . $this->table . " WHERE " . $name . " = ?");
        $query->execute([$value]);
        return $query->fetch();
    }

    public function create($data)
    {
        $string = "INSERT INTO " . $this->table;
        $rows = "(".implode(",", array_keys($data)).")";
        $values = '('.implode(',', array_fill(0, count($data), '?')).')';
        $string .= sprintf(' %s VALUES %s ', $rows, $values);
        $this->db->prepare($string)->execute(array_values($data));
    }

    public function update($data, $where)
    {
        $string = "UPDATE " . $this->table . " SET ". implode(" = ?, ", array_keys($data)) . " = ? WHERE " . sprintf(' %s = %s ', ...array_keys($where), ...array_fill(0, count($where), '?'));
        $this->db->prepare($string)->execute(array_merge_recursive(array_values($data), array_values($where)));
    }

    public function delete($data, $where)
    {
        $this->db
            ->prepare("DELETE FROM " . $this->table . " WHERE " . sprintf(' %s = %s ', ...array_keys($where), ...array_fill(0, count($where), '?')))
            ->execute(array_merge_recursive(array_values($data), array_values($where)));
    }
}
