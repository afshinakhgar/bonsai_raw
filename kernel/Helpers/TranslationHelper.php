<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/1/18
 * Time: 11:47 AM
 */

namespace Kernel\Helpers;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Kernel\Abstracts\AbstractTranslation;
use Kernel\Abstracts\ContainerInterface;

class TranslationHelper extends AbstractTranslation
{
    public $local = 'en';
    public $translator;
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        // Register the Dutch translator (set to "en" for English)
        $this->local = $container->get('settings')['local'] ?? 'en';
        $loader = new FileLoader(new Filesystem(), $container->get('settings')['app']['translation_path']);
        $this->translator = new Translator($loader, $this->local);
        return $this->translator;
    }



    public function trans($key, array $replace = [])
    {
        return $this->translator->trans($key,  $replace, $this->local );
    }

}