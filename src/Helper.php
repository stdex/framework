<?php

namespace momentphp;

/**
 * Helper
 */
abstract class Helper
{
    use traits\ContainerTrait;
    use traits\OptionsTrait;
    use traits\ClassTrait;

    /**
     * Template
     *
     * @var Template
     */
    protected $template;

    /**
     * Constructor
     *
     * @param \Psr\Container\ContainerInterface $container
     * @param array $options
     */
    public function __construct(\Psr\Container\ContainerInterface $container, Template $template, $options = [])
    {
        $this->container($container);
        $this->template = $template;
        $this->options($options);
    }
}
