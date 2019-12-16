<?php

namespace craftplugins\macroable;

use Craft;
use craftplugins\macroable\twigextensions\MacroableTwigExtension;

/**
 * Class Macroable
 *
 * @package craftplugins\macroable
 */
class Plugin extends \craft\base\Plugin
{
    /**
     * @var string
     */
    public $schemaVersion = '0.1.0';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Craft::$app->view->registerTwigExtension(
            new MacroableTwigExtension(
                Craft::$app->config->getConfigFromFile('macroable')
            )
        );
    }
}
