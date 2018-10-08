<?php
/**
 * Created by PhpStorm.
 * User: afshinakhgar
 * Date: 9/16/18
 * Time: 1:42 PM
 */

namespace Kernel\Helpers;


class PagerHelper
{
    function pagingData($request,$data,$limit)
    {
        $page      = ($request->getParam('page', 0) > 0) ? $request->getParam('page') : 1;

        $count = $data->total();
        $pagingData = [
            'needed'        => $count > $limit,
            'count'         => $count,
            'page'          => (int)$page,
            'lastpage'      => (int)(ceil($count / $limit) == 0 ? 1 : (int)ceil($count / $limit)),
            'limit'         => $limit,
        ];


        return $pagingData;
    }
}