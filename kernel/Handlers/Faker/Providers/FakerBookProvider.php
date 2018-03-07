<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/7/18
 * Time: 2:34 PM
 */

namespace Kernel\Handlers\Faker\Providers;


use Faker\Provider\Base;

class FakerBookProvider extends  Base
{
    public function title($nbWords = 5)
    {
        $sentence = $this->generator->sentence($nbWords);
        return substr($sentence, 0, strlen($sentence) - 1);
    }

    public function ISBN()
    {
        return $this->generator->ean13();
    }
}