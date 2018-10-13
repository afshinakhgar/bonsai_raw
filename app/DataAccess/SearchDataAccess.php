<?php

namespace App\DataAccess;
use App\Model\User;
use PDO;

use Kernel\Abstracts\AbstractDataAccess;

/**
 * Class TestDataAccess
 * @package App\DataAccess
 */
class SearchDataAccess extends AbstractDataAccess
{
    public function query($q,$limit)
    {
//        $sql = "SELECT * FROM users WHERE first_name LIKE :first_name";
//        $sth = $this->db->prepare($sql);
//        $sth->bindValue(':first_name', '%'.$q.'%', PDO::PARAM_INT);
//
//        $sth->execute();
//        $items = $sth->fetchAll(PDO::FETCH_OBJ);
//        return $items;



        return User::where('first_name','like','%' .$q. '%')->
            orWhere('last_name','like','%' .$q. '%')->
            orWhere('username','like','%' .$q. '%')
            ->paginate($limit);
    }


}
