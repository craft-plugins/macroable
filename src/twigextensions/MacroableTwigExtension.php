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
     * @return array|\Generator
     */
    public function getGlobals()
    {
        foreach ($this->config['globals'] as $key => $value) {
            if ($value instanceof Closure) {
                $value = $value();
            }

            yield $key => $value;
        }
    }

    /**
     * @return array|\Generator|\Twig\TwigFunction[]
     */
    public function getFunctions()
    {
        foreach ($this->config['functions'] as $key => $value) {
            yield new TwigFunction($key, $value);
        }
    }

    /**
     * @return array|\Generator|\Twig\TwigFilter[]
     */
    public function getFilters()
    {
        foreach ($this->config['filters'] as $key => $value) {
            yield new TwigFilter($key, $value);
        }
    }
}
