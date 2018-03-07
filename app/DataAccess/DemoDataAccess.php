<?php

namespace App\DataAccess;
use PDO;

use Kernel\Abstracts\AbstractDataAccess;

/**
 * Class TestDataAccess
 * @package App\DataAccess
 */
class DemoDataAccess extends AbstractDataAccess
{
    public function getOne(int $id)
    {
        $sql = "SELECT * FROM demo WHERE id=:id";
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $item['item'] = $sth->fetch(PDO::FETCH_OBJ);
        return $item;
    }
    public function getAll()
    {
        $sql = "SELECT * FROM demo  ORDER BY id DESC";
        $sth = $this->db->prepare($sql);

        $sth->execute();
        $items = $sth->fetchAll(PDO::FETCH_OBJ);
        return $items;
    }

}
