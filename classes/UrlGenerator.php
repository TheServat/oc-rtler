<?php
namespace RtlWeb\Rtler\Classes;

use File;
use Config;
use Request;
use Illuminate\Routing\UrlGenerator as baseGenerator;
use RtlWeb\Rtler\Models\Settings;

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
        $languages = Settings::get('languages', ['fa']);
        if (!is_array($languages)) {
            if($languages == 0){
                $languages = 'fa';
            }
            $languages = [$languages];
        }

        if (array_search(\Lang::getLocale(),$languages) === false) {
            return parent::asset($path, $secure);
        }
        if ($this->isValidUrl($path)) return $path;

        $backendUri = Config::get('cms.backendUri');
        $requestUrl = Request::url();
        if (File::exists(
            base_path(dirname($path)) . '.rtl.' . File::extension($path)
        )
        ) {
            $path = dirname($path) . '.rtl.' . File::extension($path);
        } else if (File::extension($path) == 'css' && (strpos($requestUrl, $backendUri) || strpos($path, 'plugins/') || strpos($path, 'modules/'))) {
            $path = CssFlipper::flipCss($path);
        }

        // Once we get the root URL, we will check to see if it contains an index.php
        // file in the paths. If it does, we will remove it since it is not needed
        // for asset paths, but only for routes to endpoints in the application.
        $root = $this->getRootUrl($this->getScheme($secure));

        return $this->removeIndex($root) . '/' . trim($path, '/');
    }
}
