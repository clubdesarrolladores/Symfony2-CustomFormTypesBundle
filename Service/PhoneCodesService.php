<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Service;

use Symfony\Component\Config\FileLocator;
use \Symfony\Component\Yaml\Yaml;

/**
 * Get list of phone codes from yaml file
 */
class PhoneCodesService
{
    /**
     * Get list of phone codes for choice list
     */
    public static function getPhoneCodes()
    {
        // get current locale if null
        $locale = \Locale::getDefault();
        
        // load file with list of phone codes
        $locator = new FileLocator(__DIR__.'/../Resources/data/phone_codes');
        $codes_file = $locator->locate('codes.'.$locale.'.yml');
        
        // parse yaml file to array
        $codes = Yaml::parse(file_get_contents($codes_file));

        return $codes;
    }
}
