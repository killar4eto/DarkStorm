<?php
namespace App\Models;

use Core\Classes\Model;

class Picture extends Model
{
    public function getAll()
    {
        $query = $this->db->query('SELECT * FROM pictures ORDER BY id DESC');
        return $query->fetchAll();
    }

    public function getTop12()
    {
        $query = $this->db->query('SELECT * FROM pictures ORDER BY id DESC LIMIT 12');
        return $query->fetchAll();
    }

    public function findId($id)
    {
        $query = $this->db->prepare("SELECT * FROM pictures WHERE id = ? LIMIT 1");
        $query->execute([$id]);
        return $query->fetch();
    }

    public function create($title, $url)
    {
        $data = array(
            'title' => $title,
            'url' => $url,
        );
        $this->db->prepare("INSERT INTO `pictures` (`title`, `url`) VALUES (:title, :url)")->execute($data);
    }

    public function update($id, $title, $url)
    {
        $data = array(
            'id' => $id,
            'title' => $title,
            'url' => $url,
        );
        $this->db->prepare("UPDATE `pictures` SET `title` = :title, `url` = :url WHERE `id` = :id")->execute($data);
    }
    
    public function delete($id)
    {
        $data = array('id' => $id);
        $this->db->prepare("DELETE FROM `pictures` WHERE `id` = :id")->execute($data);
    }
}
