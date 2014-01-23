<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\Service;

use Symfony\Component\Config\FileLocator;
use \Symfony\Component\Yaml\Yaml;

/**
 * Get list of US states from yaml file
 */
class USStatesService
{
    /**
     * Get list of US states for choice list
     */
    public static function getUSStates()
    {
        // get current locale if null
        $locale = \Locale::getDefault();
        
        // load file with list of states
        $locator = new FileLocator(__DIR__.'/../Resources/data/states');
        $country_file = $locator->locate('us_states.'.$locale.'.yml');
        
        // parse yaml file to array
        $countries = Yaml::parse(file_get_contents($country_file));

        return $countries;
    }
}
