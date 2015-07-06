<?php
namespace RtlWeb\RtlSkin\Skins;

use Backend\Classes\Skin;
use File;

/**
 * RTL skin information file
 *
 * @package RtlWeb\RtlSkin
 * @author Sajjad SErvatjoo
 */
class RtlSkin extends Skin
{


    /**
     * {@inheritDoc}
     */
    public function skinDetails()
    {
        return [
            'name' => 'Right-To-Left Skin'
        ];
    }
}
