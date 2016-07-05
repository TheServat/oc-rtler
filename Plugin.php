<?php namespace RtlWeb\Rtler;

use Backend;
use Config;
use File;
use Request;
use Cms\Classes\Theme;
use System\Classes\CombineAssets;
use System\Classes\PluginBase;
use System\Classes\MarkupManager;
use System\Classes\PluginManager;
use RtlWeb\Rtler\Classes\CssFlipper;
use RtlWeb\Rtler\Classes\UrlGenerator;
use October\Rain\Router\Helper as RouterHelper;
use System\Classes\SettingsManager;


/**
 * Rtler Plugin Information File
 */
class Plugin extends PluginBase
{
    public function __construct($app)
    {
        parent::__construct($app);

        // if uri is system module and request not ajax run plugin
        $path = RouterHelper::normalizeUrl(Request::path());
        $backendUri = RouterHelper::normalizeUrl(Config::get('cms.backendUri', 'backend'));
        $request = $backendUri . '/system/';

        if (stripos($path, $request) === 0) {
            if (!Request::ajax() || Request::method() != 'POST') {
                PluginManager::$noInit = false;
            }
        }

    }


    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'rtlweb.rtler::lang.plugin.name',
            'description' => 'rtlweb.rtler::lang.plugin.description',
            'author' => 'Sajjad Servatjoo & Saman Sorushniya',
            'icon' => 'icon-leaf'
        ];
    }

    public function boot()
    {
        \Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addJs(\Config::get('cms.pluginsPath') . ('/rtlweb/rtler/assets/js/rtler-min.js'));
            $controller->addCss(\Config::get('cms.pluginsPath') . ('/rtlweb/rtler/assets/css/custom.css'));
        });
    }

    public function register()
    {
        $this->registerAssetBundles();
        $this->registerMarkupTags();
        $this->registerUrlGenerator();
    }

    /**
     * Register asset bundles
     */
    protected function registerAssetBundles()
    {
        CombineAssets::registerCallback(function ($combiner) {
            $combiner->registerBundle( '$/rtlweb/rtler/assets/js/rtler.js');
        });
    }

    protected function registerUrlGenerator()
    {
        $this->app['url'] = $this->app->share(function ($app) {
            $routes = $app['router']->getRoutes();

            $url = new UrlGenerator(
                $routes, $app->rebinding(
                'request', $this->requestRebinder()
            ));

            $url->setSessionResolver(function () {
                return $this->app['session'];
            });

            // If the route collection is "rebound", for example, when the routes stay
            // cached for the application, we will need to rebind the routes on the
            // URL generator instance so it has the latest version of the routes.
            $app->rebinding('routes', function ($app, $routes) {
                $app['url']->setRoutes($routes);
            });

            return $url;
        });
    }

    protected function requestRebinder()
    {
        return function ($app, $request) {
            $app['url']->setRequest($request);
        };
    }

    /**
     * Registers CMS markup tags introduced by this plugin.
     */
    public function registerMarkupTags()
    {
        MarkupManager::instance()->registerCallback(function ($manager) {
            $manager->registerFilters([
                // Classes
                'flipCss' => [$this, 'flipCss'],
            ]);
        });
    }

    /**
     * Registers any back-end configuration for Rtler.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'rtler' => [
                'label' => 'rtlweb.rtler::lang.plugin.name',
                'description' => 'rtlweb.rtler::lang.plugin.description',
                'category' => 'rtlweb.rtler::lang.plugin.name',
                'icon' => 'icon-magic',
                'class' => 'RtlWeb\Rtler\Models\Settings',
                'order' => 500,
                'permissions' => ['rtlweb.rtler.manage'],
                'keywords' => 'rtl rtler'
            ]
        ];

    }

    public function registerPermissions()
    {
        return [
            'rtlweb.rtler.manage' => [
                'tab' => 'system::lang.permissions.name',
                'label' => 'Manage Rtler'
            ]
        ];
    }

    /**
     * Twig Markup tag 'flipCss'
     * @param $paths
     * @param bool $force
     * @return array|string
     */
    public function flipCss($paths, $force = false)
    {
        if (trans('system::lang.direction') != 'rtl' && $force == false) {
            return $paths;
        }
        if (!is_array($paths)) {
            $paths = [$paths];
        }
        $rPaths = [];
        foreach ($paths as $path) {
            $assetPath = $path;
            if (File::exists(dirname($assetPath) . '/' . File::name($assetPath) . '.rtl.' . File::extension($assetPath))) {
                $newPath = dirname($assetPath) . '.rtl.' . File::extension($assetPath);
            } else {
                $newPath = CssFlipper::flipCss($assetPath, true);
            }
            $rPaths[] = $newPath;
        }
        return $rPaths;
    }
}
