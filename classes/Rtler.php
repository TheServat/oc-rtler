<?php namespace RtlWeb\Rtler\Classes;

use Event;
use Config;
use Request;
use System\Classes\MarkupManager;
use October\Rain\Support\Traits\Singleton;

class Rtler
{
    use Singleton;

    protected $app;
    public function init(){
        $this->app = app();

        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            if (!Request::ajax() && LanguageDetector::isRtl()) {
                $controller->addJs(Config::get('cms.pluginsPath') . ('/rtlweb/rtler/assets/js/rtler-min.js'));
                $controller->addCss(Config::get('cms.pluginsPath') . ('/rtlweb/rtler/assets/css/rtl.css'));
            }
        });
    }
    public function register(){
        $this->registerUrlGenerator();
        $this->registerMarkupTags();
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
     * Twig Markup Filter 'flipCss'
     * @param $paths
     * @param bool $force
     * @return array|string
     */
    public function flipCss($paths)
    {
        if (!LanguageDetector::isRtl()) {
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
