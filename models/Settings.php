<?php namespace RtlWeb\Rtler\Models;


use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'rtlweb_rtler_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public function getLanguagesOptions()
    {
        return trans('system::lang.locale');
    }


}