<?php

namespace momentphp;

use Twig_Extension_Debug;
use Twig_Extension_Profiler;
use Twig_Profiler_Profile;

/**
 * TwigViewEngine
 */
class TwigViewEngine implements \momentphp\interfaces\ViewEngineInterface
{
    /**
     * Twig
     *
     * @var \Twig_Environment
     */
    public $twig;

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        if (!file_exists($options['compile'])) {
            mkdir($options['compile'], 0777, true);
        }

        $loader = new \Twig_Loader_Filesystem;
        // register paths inside main namespace
        foreach ($options['templates'] as $namespace => $path) {
            if (file_exists($path)) {
                $loader->addPath($path);
            }
        }
        // register paths inside bundles namespaces
        foreach ($options['templates'] as $namespace => $path) {
            if (file_exists($path)) {
                $loader->addPath($path, $namespace);
            }
        }

        $debug = isset($options['debug']) ? $options['debug'] : false;
        $options['autoescape'] = isset($options['autoescape']) ? $options['autoescape'] : false;

        $environmentOptions = [
            'cache' => $options['compile'],
            'autoescape' => $options['autoescape'],
            'debug' => $debug,
        ];

        $this->twig = new \Twig_Environment($loader, $environmentOptions);

        if ($debug) {
            $twigProfile = new Twig_Profiler_Profile();
            $this->twig->addExtension(new Twig_Extension_Profiler($twigProfile));
            $this->twig->addExtension(new Twig_Extension_Debug());
        }
    }

    /**
     * Render template content
     *
     * @param  string $template
     * @param  array $data
     * @param  null|string $bundle
     * @return string
     */
    public function render($template, $data = [], $bundle = null)
    {
        return $this->twig->render($this->template($template, $bundle), $data);
    }

    /**
     * Check if given template exists
     *
     * @param  string $template
     * @param  null|string $bundle
     * @return boolean
     */
    public function exists($template, $bundle = null)
    {
        return $this->twig->getLoader()->exists($this->template($template, $bundle));
    }

    /**
     * Return template path
     *
     * @param  string $template
     * @param  null|string $bundle
     * @return string
     */
    protected function template($template, $bundle = null)
    {
        if ($bundle !== null) {
            $template = '@' . $bundle . '/' . $template;
        }
        return $template . '.twig';
    }
}
