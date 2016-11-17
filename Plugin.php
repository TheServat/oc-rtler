<?php namespace RtlWeb\Rtler;

use Backend;
use System\Classes\CombineAssets;
use System\Classes\PluginBase;
use October\Rain\Router\Helper as RouterHelper;
use System\Classes\SettingsManager;
use RtlWeb\Rtler\Classes\Rtler;


/**
 * Rtler Plugin Information File
 */
class Plugin extends PluginBase
{
    public $elevated = true;

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

    }

    public function register()
    {
        $this->registerAssetBundles();
        Rtler::instance()->register();
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

  
    public function registerPermissions()
    {
        return [
            'rtlweb.rtler.manage' => [
                'tab' => 'system::lang.permissions.name',
                'label' => 'Manage Rtler'
            ]
        ];
    }
}
