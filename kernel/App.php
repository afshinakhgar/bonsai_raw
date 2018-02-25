<?php
namespace Kernel;

/**
 * Class App
 * @package Kernel
 */

class App extends \Slim\App
{
    /**
     * @var string
     */
    protected $environment;
    /**
     * @var string
     */
    protected $rootDir;

    /**
     * Constructor.
     *
     * @param string $environment
     */
    public function __construct($config)
    {
        $this->environment = $config['settings']['app']['env'] ?? 'dev';
        parent::__construct($config);

    }

    public function getEnvironment()
    {
        return $this->environment;
    }
}