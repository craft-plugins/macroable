<?php

namespace craftplugins\macroable\twigextensions;

use Closure;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Class MacroableTwigExtension
 *
 * @package craftplugins\macroable\twigextensions
 */
class MacroableTwigExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * MacroableTwigExtension constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Macroable';
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        $globals = [];

        foreach ($this->config['globals'] as $key => $value) {
            if ($value instanceof Closure) {
                $value = $value();
            }

            $globals[$key] = $value;
        }

        return $globals;
    }

    /**
     * @return \Twig\TwigFunction[]
     */
    public function getFunctions()
    {
        $functions = [];

        foreach ($this->config['functions'] as $key => $value) {
            $functions[] = new TwigFunction($key, $value);
        }

        return $functions;
    }

    /**
     * @return \Twig\TwigFilter[]
     */
    public function getFilters()
    {
        $filters = [];

        foreach ($this->config['filters'] as $key => $value) {
            $filters[] = new TwigFilter($key, $value);
        }

        return $filters;
    }
}
