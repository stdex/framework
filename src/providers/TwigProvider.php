<?php

namespace momentphp\providers;

use momentphp\Provider;
use momentphp\TwigViewEngine;

/**
 * TwigProvider
 */
class TwigProvider extends Provider
{
    /**
     * Register service
     */
    public function __invoke()
    {
        $options = $this->options();
        if ($this->container()->has('debug')) {
            $options['debug'] = $this->container()->get('debug');
            $options['twig_profile'] = $this->container()->has('twig_profile') ? $this->container()->get('twig_profile') : null;
        }

        $this->container()->get('app')->service('twig', function () use ($options) {
            return new TwigViewEngine($options);
        });
    }
}
