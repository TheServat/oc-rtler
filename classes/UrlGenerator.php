<?php
namespace RtlWeb\RtlSkin\Classes;

use File;
use Config;
use Request;
use Illuminate\Routing\UrlGenerator as baseGenerator;

class UrlGenerator extends baseGenerator
{
    /**
     * Generate a URL to an application asset.
     *
     * @param  string $path
     * @param  bool|null $secure
     * @return string
     */
    public function asset($path, $secure = null)
    {
        if(trans('system::lang.direction') != 'rtl'){
            return parent::asset($path,$secure);
        }
        if ($this->isValidUrl($path)) return $path;

        $backendUri = Config::get('cms.backendUri');
        $requestUrl = Request::url();

        if (File::extension($path) == 'css' && preg_match('/\/' . $backendUri . '/', $requestUrl)) {
            $path = CssFlipper::flipCss($path);
        }

        // Once we get the root URL, we will check to see if it contains an index.php
        // file in the paths. If it does, we will remove it since it is not needed
        // for asset paths, but only for routes to endpoints in the application.
        $root = $this->getRootUrl($this->getScheme($secure));

        return $this->removeIndex($root) . '/' . trim($path, '/');
    }
}
